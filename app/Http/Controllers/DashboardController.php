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
        $visitors=$analytics->count()>0?$analytics->sum('visitors'):0;
        $data=[
            'title'=>'Dashboard | E-Katalog Khalis Bali Bamboo',
            'countCustomers'=>User::where('level','user')->where('active',1)->count(),
            'countProducts'=>Product::all()->count(),
            'top_products'=>Product::withCount('wishlists')->orderBy('wishlists_count','desc')->filter(request(['month']))->take(10)->get(),
            'totalVisitors'=>$visitors
            
        ];
        return view('admin.dashboard',$data);
    }
}