<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable=['user_id','product_code'];

    // relationship
    public function product(){
        return $this->belongsTo(Product::class,'product_code');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    // relationship

    public static function countWishlist($product_code){
        $countWishlist=Wishlist::where(['user_id'=>Auth::user()->id,'product_code'=>$product_code])->count();
        return $countWishlist;
    }
    
    // scopes
    public function scopeFilter($query,array $filters){
        $query->when($filters['category']??false,function($query,$category){
            return $query->WhereHas('product',function($query)use($category){
                $query->whereHas('category',function($query)use($category){
                    $query->where('slug',$category);
                });
            });
        });
        // $query->when($filters['category']??false,function($query,$category){
        //     return $query->WhereHas('category',function($query)use($category){
        //         $query->where('slug',$category);
        //     });
        // });
        $query->when($filters['search']??false,function($query,$search){
            return $query->WhereHas('product',function($query)use($search){
                $query->where('name','like','%'.$search.'%')->orWhere('product_code','like','%'.$search.'%');
            });
            // return $query->where('name','like','%'.$search.'%')->orWhere('product_code','like','%'.$search.'%')->orWhereHas('category',function($query)use($search){
            //    $query->where('name','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%');
            // });
        });
    } 
    // scopes


}