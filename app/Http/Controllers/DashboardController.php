<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        // dd(Wishlist::latest()->count());
        $data=[
            'title'=>'Dashboard | E-Katalog Khalis Bali Bamboo',
            'countCustomers'=>User::where('level','user')->count(),
            'countProducts'=>Product::all()->count(),
            'top_products'=>Product::withCount('wishlists')->orderBy('wishlists_count','desc')->filter(request(['month']))->take(10)->get(),
            
        ];
        return view('admin.dashboard-overview',$data);
    }
}