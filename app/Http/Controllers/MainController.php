<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function main(){
        if(Product::with('wishlist')->count()){
            $top_products=Product::withCount('wishlists')->orderBy('wishlists_count','desc')->take(3)->get();
        }else{
            $top_products=Product::inRandomOrder()->take(3)->get();
        }
        $data=[
            'title'=>'Bamboo Furniture Wholesale Manufacturer & Exporter - Home | Khalis Bali Bamboo',
            'top_products'=>$top_products,
            'latest_products'=>Product::latest()->take(3)->get()
        ];
        return view('frontpage.main',$data);
    }
    public function products(){
          $data=[
            'title'=>'Find Your Perfect Bamboo Furniture - Our Products | Khalis Bali Bamboo',
            'products'=>Product::latest()->filter(request(['search','category']))->paginate(12)->withQueryString(),
            'categories'=>Category::orderBy('name','asc')->get()
        ];
        return view('frontpage.product',$data);
    }

    public function productDetail(Product $product){
        $currentUrl=request()->url();
        $shareUrls=[
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($currentUrl),
            'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode($currentUrl),
            'linkedin' => 'https://www.linkedin.com/shareArticle?url=' . urlencode($currentUrl),
            'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($currentUrl),
            'line'=> 'https://social-plugins.line.me/lineit/share?url=' . urlencode($currentUrl)
        ];
        $data=[
            'title'=>$product->name.' - '.$product->category->name.' | Khalis Bali Bamboo',
            'product'=>$product,
            'categories'=>Category::orderBy('name','asc')->get(),
            'shareLink'=>$shareUrls
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
            'title'=>'Save Your Favorites - My Wishlist | Khalis Bali Bamboo',
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

    public function storeFeedback(Request $request){
        $validator=Validator::make($request->all(),[
            'rating'=>'required|integer',
            'message'=>'nullable|string'

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','There must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $created_feedback=Feedback::create([
            'user_id'=>Auth::user()->id,
            'rating'=>$validated['rating'],
            'message'=>$validated['message'],
            'status'=>'unreviewed',
        ]);
        if($created_feedback){
            return redirect()->route('main.contact-us')->with('success','Your Feedback Has Been Sent');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }
}