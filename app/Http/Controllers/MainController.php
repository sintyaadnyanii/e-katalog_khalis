<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function products(){
          $data=[
            'title'=>'All Products| E-Katalog Khalis Bali Bamboo',
            'products'=>Product::latest()->filter(request(['search','category']))->paginate(12)->withQueryString(),
            'categories'=>Category::latest()->get()
        ];
        return view('frontpage.product',$data);
    }
}