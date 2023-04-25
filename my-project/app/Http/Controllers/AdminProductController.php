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
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order = 'id', $direction = 'desc')
    {
        $products = Product::orderBy($order, $direction)->paginate(6);

        return view('admin.products.index', compact('products', 'order', 'direction'));
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
            'status' => 'required|string|in:disponible,no disponible',
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
                'brand_id' => $request->brand,
                'status' => $request->status
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

        return back()->with('message', 'Producto creado con éxito');
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
            'status' => 'required|string|in:disponible,no disponible',
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
                'brand_id' => $request->brand,
                'status' => $request->status
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
                return [$size => [
                    'stock' => $stocks[$index],
                    'created_at' => now(),
                    'updated_at' => now()
                ]];
            });
            $product->description->sizes()->sync($sizeStocks->all());

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
            return back()->with('error', 'Error al editar el producto');
        }

        return back()->with('message', 'Empleado actualizado con éxito');
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

            // Actualización estado producto
            Product::where('id', $id)->update([
                'status' => 'no disponible'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al cambiar estado del producto con id: ' . $id);
        }

        return back()->with('message', 'Producto con id [' . $id . '] no disponible correctamente');
    }

    public function destroyImage($id)
    {
        try {
            DB::beginTransaction();

            $image = Image::findOrFail($id);

            // Eliminar la imagen del sistema de archivos
            if (Storage::delete('public/images/' . basename($image->url))) {
                $image->delete();
                DB::commit();

                return back()->with('message', 'Imagen con id [' . $id . '] eliminada con éxito');
            } else {
                DB::rollBack();
                return back()->with('error', 'Error al eliminar la imagen con id: ' . $id);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar la imagen con id: ' . $id);
        }
    }
}
