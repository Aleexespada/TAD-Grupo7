<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(6);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        if (
            $request->status == 'pendiente' || $request->status == 'en proceso'
            || $request->status == 'entregado' || $request->status == 'cancelado'
        )
            try {
                DB::beginTransaction();

                Order::where('id', $id)->update([
                    'status' => $request->status
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Error al cambiar estado del pedido');
            }
        else {
            return back()->with('error', 'Error al cambiar estado del pedido');
        }

        return back()->with('message', 'Estado del pedido con ID: ' . $id . ' cambiado con exito');
    }
}
