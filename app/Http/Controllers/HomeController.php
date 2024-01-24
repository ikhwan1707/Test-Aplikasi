<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Customer;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthlySales = Order::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), 
        DB::raw('SUM(subtotal) as total'))->groupBy('month')
        ->get();
        
        $productCount = Product::count();
        $shippingCount = Order::where('status', '2')->count();
        $currentDate = Carbon::now()->toDateString(); 
        $totalRevenue = Order::whereDate('created_at', $currentDate)->sum('subtotal');

        $startDate = Carbon::now()->subDays(7); // Mendapatkan tanggal tujuh hari yang lalu
        $endDate = Carbon::now(); // Tanggal hari ini

        $registeredUsersCount = Customer::whereBetween('created_at', [$startDate, $endDate])->count();

        $chartData = [
            'labels' => $monthlySales->pluck('month'),
            'datasets' => [
                [
                    'label' => 'Penjualan Bulanan',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                    'data' => $monthlySales->pluck('total'),
                ],
            ],
        ];
        
        return view('home', compact('productCount', 'shippingCount', 'totalRevenue', 'registeredUsersCount', 'chartData'));
    }
}