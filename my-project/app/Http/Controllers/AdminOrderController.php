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
    public function index($order = 'id', $direction = 'desc')
    {
        $orders = Order::orderBy($order, $direction)->paginate(6);

        return view('admin.orders.index', compact('orders', 'order', 'direction'));
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

        return back()->with('message', 'Estado del pedido con ID: ' . $id . ' cambiado con éxito');
    }
}
