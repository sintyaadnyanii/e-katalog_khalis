<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function main(){
        if(Product::with('wishlist')->count()){
            $top_products=Product::latest()->get();
        }else{
            $top_products=Product::withCount('wishlists')->orderBy('wishlists_count','desc')->get();
        }
        $data=[
            'title'=>'Home| E-Katalog Khalis Bali Bamboo',
            'top_products'=>$top_products,
        ];
        return view('frontpage.main',$data);
    }
    public function products(){
          $data=[
            'title'=>'All Products| E-Katalog Khalis Bali Bamboo',
            'products'=>Product::latest()->filter(request(['search','category']))->paginate(12)->withQueryString(),
            'categories'=>Category::orderBy('name','asc')->get()
        ];
        return view('frontpage.product',$data);
    }

    public function detailProduct(Product $product){
          $data=[
            'title'=>'All Products| E-Katalog Khalis Bali Bamboo',
            'product'=>$product,
            'categories'=>Category::orderBy('name','asc')->get()
        ];
        return view('frontpage.product-detail',$data);
    }
    public function addWishlist(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $countWishlist=Wishlist::countWishlist($data['product_code']);
            if($countWishlist==0){
                Wishlist::create([
                    'product_code'=>$data['product_code'],
                    'user_id'=>Auth::user()->id
                ]);
                $likes=Wishlist::where('product_code',$data['product_code'])->count();
                $addedProduct=Wishlist::where('user_id',Auth::user()->id)->count();
                return response()->json(['action'=>'add','message'=>'Product Added Successfully to Wishlist','likes'=>$likes,'added_product'=>$addedProduct]);
            }
            else{
            Wishlist::where(['user_id'=>Auth::user()->id,'product_code'=>$data['product_code']])->delete();
            $likes=Wishlist::where('product_code',$data['product_code'])->count();
            $addedProduct=Wishlist::where('user_id',Auth::user()->id)->count();
            return response()->json(['action'=>'remove','message'=>'Product Removed Successfully from Wishlist','likes'=>$likes,'added_product'=>$addedProduct]);
        }
        }
    }

    public function myWishlist(){
        $data=[
            'title'=>'All Products| E-Katalog Khalis Bali Bamboo',
            'wishlists'=>Wishlist::where('user_id',Auth::user()->id)->filter(request(['search','category']))->paginate(10)->withQueryString(),
            'categories'=>Category::orderBy('name','asc')->get()
        ];
        return view('frontpage.wishlist',$data);
    }

    public function deleteWishlist(Wishlist $wishlist){
        if ($wishlist->delete()) {
            return redirect()->route('main.wishlist')->with('success','Product: '.$wishlist->product->name.' Removed From Wishlist');
        }
        return redirect()->back()->with('error','An Error Occured, Please Try Again!');
    }
}