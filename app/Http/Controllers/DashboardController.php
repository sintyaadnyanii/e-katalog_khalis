<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function dashboard(){
        // dd(Wishlist::latest()->count());
        $analytics=Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $totalVisitors=0;
        foreach ($analytics as $item) {
            $totalVisitors += $item['activeUsers'];
        }
        if(request()->query('month')){
            $monthYear=request()->query('month');
            $year = substr($monthYear, 0, 4);
            $month = substr($monthYear, 5, 2);
            $top_products=Product::withCount(['wishlists' => function ($query) use ($year,$month) {
                        $query->whereYear('created_at',$year)->whereMonth('created_at',$month);
                        }])->orderBy('wishlists_count','desc')->take(5)->get();
        }else{
            $year=date('Y');
            $top_products=Product::withCount(['wishlists' => function ($query) use ($year) {
                        $query->whereYear('created_at',$year);
                        }])->orderBy('wishlists_count','desc')->take(5)->get();
        }
          
        $data=[
            'title'=>'Dashboard | E-Katalog Khalis Bali Bamboo',
            'countCustomers'=>User::where('level','user')->where('active',1)->count(),
            'countProducts'=>Product::all()->count(),
            // 'top_products'=>Product::withCount('wishlists')->orderBy('wishlists_count','desc')->filter(request(['month']))->take(10)->get(),
            'top_products'=>$top_products,
            'totalVisitors'=>$totalVisitors
            
        ];
        return view('admin.dashboard',$data);
    }
}