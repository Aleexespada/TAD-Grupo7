<?php

namespace App\Http\Controllers;

use App\Charts\OrdersPerDayChart;
use App\Charts\ProductsCategoriesChart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orders_per_day_data = $this->createOrdersPerDayChart();

        $first_date = Carbon::now()->subDays(10)->format('Y-m-d');
        $data = Order::select(DB::raw('DATE(order_date) as fecha'), DB::raw('sum(total_price) as total'))
            ->where('order_date', '>', $first_date)
            ->groupBy('fecha')
            ->get();
        $last_10_days_total = $data->sum('total');

        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
        $total_orders_month = Order::whereBetween('order_date', [$startDate, $endDate])->get()->count();
        $total_price_month = Order::whereBetween('order_date', [$startDate, $endDate])->sum('total_price');

        $total_orders = Order::count();
        $total_prices = Order::sum('total_price');

        $orders_per_category = $this->createOrdersByCategoryChart();

        return view('admin.home', compact('last_10_days_total', 'orders_per_day_data', 'total_orders', 'total_prices', 'total_orders_month', 'total_price_month', 'orders_per_category'));
    }

    private function createOrdersPerDayChart()
    {
        $first_date = Carbon::now()->subDays(10)->format('Y-m-d');

        // Generar una lista de fechas de los últimos 10 días
        $last_10_days_dates = [];
        for ($i = 9; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $last_10_days_dates[] = $date;
        }

        // Obtener los datos de los pedidos en los últimos 10 días
        $data = Order::select(DB::raw('DATE(order_date) as fecha'), DB::raw('count(*) as total'))
            ->where('order_date', '>', $first_date)
            ->groupBy('fecha')
            ->get();

        // Combinar las fechas de los últimos 10 días con los datos de los pedidos
        $dates = array_merge($last_10_days_dates, $data->pluck('fecha')->toArray());
        $dates = array_unique($dates); // Eliminar duplicados
        // Convertir las fechas a objetos Carbon y formatearlas
        $formated_dates = [];
        foreach ($dates as $date) {
            $date_carbon = Carbon::parse($date);
            $formated_date = $date_carbon->format('d M');
            $formated_dates[] = $formated_date;
        }

        sort($formated_dates); // Ordenar las fechas formateadas

        // Usar las fechas formateadas en lugar de las originales
        $dates = $formated_dates;

        // Generar un vector con los totales de los pedidos en cada fecha
        $totals = array_fill_keys($dates, 0);
        foreach ($data as $pedido) {
            $totals[Carbon::parse($pedido->fecha)->format('d M')] = $pedido->total;
        }

        $data = [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'data' => $totals,
                ]
            ]
        ];

        return $data;
    }

    private function createOrdersByCategoryChart()
    {
        $categories = DB::table('categories')->pluck('name')->toArray();
        $ordersByCategory = DB::table('orders')
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->get();

        $totalPerCategory = array_fill_keys($categories, 0);
        foreach ($ordersByCategory as $category) {
            $totalPerCategory[$category->name] = $category->total;
        }

        $data = [
            'labels' => $categories,
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => array_values($totalPerCategory),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgb(75, 192, 192, 0.5)',
                        'rgb(153, 102, 255, 0.5)',
                        'rgb(255, 159, 64, 0.5)',
                        'rgb(240, 120, 150, 0.5)'
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgb(75, 192, 192, 1)',
                        'rgb(153, 102, 255, 1)',
                        'rgb(255, 159, 64, 1)',
                        'rgb(240, 120, 150, 1)'
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];

        return $data;
    }
}
