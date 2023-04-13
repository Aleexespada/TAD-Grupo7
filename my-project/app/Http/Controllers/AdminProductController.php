<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Description;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();

        return view('admin.products.create', compact('categories', 'brands', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|max:2048',
            'description' => 'required|string',
            'details' => 'required|string',
            'color' => 'required|string',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,id',
            'stocks' => 'required|array|min:1',
            'stocks.*' => 'integer|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Crea el producto
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'brand_id' => $request->brand
            ]);

            // Relaciona el producto con las categorías
            foreach ($request->categories as $category_id) {
                $category = Category::findOrFail($category_id);
                $product->categories()->attach($category, ['created_at' => now(), 'updated_at' => now()]);
            }

            // Crea la descripción
            $description = Description::create([
                'product_id' => $product->id,
                'description' => $request->description,
                'details' => $request->details,
                'color' => $request->color
            ]);

            // Relaciona las tallas con sus respectivos stocks con la descripción
            for ($i = 0; $i < count($request->sizes); $i++) {
                $size_id = $request->sizes[$i];
                $size = Size::findOrFail($size_id);
                $description->sizes()->attach($size, ['stock' => $request->stocks[$i], 'created_at' => now(), 'updated_at' => now()]);
            }

            // Guarda la imagen en la bd y en la carpeta storage/app/public/images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    Image::create([
                        'url' => 'storage/' . str_replace('public/', '', $file->store('public/images')),
                        'product_id' => $product->id
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear producto');
        }

        return back()->with('message', 'Producto creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|max:2048',
            'description' => 'required|string',
            'details' => 'required|string',
            'color' => 'required|string',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,id',
            'stocks' => 'required|array|min:1',
            'stocks.*' => 'integer|min:0'
        ]);

        $product = Product::findOrFail($id);

        try {
            DB::beginTransaction();

            // Actualización producto
            Product::where('id', $product->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'brand_id' => $request->brand
            ]);

            // Actualización descripción
            Description::where('id', $product->description->id)->update([
                'description' => $request->description,
                'details' => $request->details,
                'color' => $request->color
            ]);

            // Actualización categorías producto
            $categories = collect($request->categories)->mapWithKeys(function ($categoryId) {
                return [$categoryId => ['created_at' => now(), 'updated_at' => now()]];
            });
            $product->categories()->sync($categories->all());

            // Actualización tallas con stocks productos
            $sizes = $request->sizes;
            $stocks = $request->stocks;
            $sizeStocks = collect($sizes)->mapWithKeys(function ($size, $index) use ($stocks) {
                return [ $size => [
                    'stock' => $stocks[$index],
                    'created_at' => now(),
                    'updated_at' => now()
                ]];
            });
            $product->description->sizes()->sync($sizeStocks->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al editar el producto');
        }

        return back()->with('message', 'Empleado actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $description = Description::where('product_id', $id)->first();
            $product = Product::findOrFail($id);
            $images = $product->images;

            if ($description && $product) {
                if ($images->count() > 0) {
                    foreach ($images as $image) {
                        $image->delete();
                    }
                }
                $description->delete();
                $product->delete();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar producto con id: ' . $id);
        }

        return back()->with('message', 'Producto con id [' . $id . '] eliminado correctamente');
    }
}
