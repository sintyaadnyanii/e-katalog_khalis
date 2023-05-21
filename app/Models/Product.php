<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey='product_code';
    protected $fillable=['product_code','category_id','name','dimensions','color','materials','price','description','link_shopee'];

    // relations
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }
    // relations

    public function wishlists(){
        return $this->hasMany(Wishlist::class,'product_code');
    }
    
    // scopes
    public function scopeFilter($query,array $filters){
        $query->when($filters['category']??false,function($query,$category){
            return $query->WhereHas('category',function($query)use($category){
                $query->where('slug',$category);
            });
        });
        $query->when($filters['search']??false,function($query,$search){
            return $query->where('name','like','%'.$search.'%')->orWhere('product_code','like','%'.$search.'%')->orWhereHas('category',function($query)use($search){
               $query->where('name','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%');
            });
        });
    } 
    // scopes

    // generate product code
    public static function generatedCode($category_id){
        $first_char=[];
        $code_numbers=[];
        if(Category::where('id',$category_id)->get()->count()){
            // mengambil slug berdasarkan berdasarkan category_id dan membuat inisial slug dalam format uppercase
            $category=Category::where('id',$category_id)->first();
            $slug_words=explode('-',$category->slug);
            foreach ($slug_words as $word) {
                $first_char[] = $word[0];
            }
            $slug_initial=Str::upper(implode('',$first_char));

            if(Product::where('category_id',$category_id)->get()->count()){
                /*mengambil 3 digit terakhir dari product_code milik setiap produk
                dalam kategori tertentu berdasarkan category_id dan mengubahnya ke integer*/
                $products=Product::where('category_id',$category_id)->get();
                foreach ($products as $product){
                    $code_number=substr($product->product_code,-3);
                    $code_numbers[]=(int)$code_number;
                }
                $max_num=max($code_numbers); //mengambil nilai terbesar dari seluruh product_code
            }else{
                $max_num=0;
            }     
            //membuat product_code
            $product_code='KH-'.$slug_initial.str_pad($max_num+1,3,0,STR_PAD_LEFT);
            return $product_code;
        }
		
    }
    // generate product code

    // events
    public static function boot(){
        parent::boot();

        self::created(function ($product) {
            foreach (request()->file('images') ?? [] as $key => $image) {
                $uploaded = Image::uploadImage($image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $product->product_code,
                    'imageable_type' => "App\Models\Product"
                ]);
            }
        });

        self::updating(function ($product){
            $img_array = explode(',', request()->deleted_images);
            array_pop($img_array);
            foreach ($img_array as $key => $image_id) {
                $will_deleted_image = Image::find($image_id);
                if (!is_null($will_deleted_image)) {
                    $will_deleted_image->delete();
                }
            }

            foreach (request()->file('images') ?? [] as $key => $image) {
                $uploaded = Image::uploadImage($image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $product->product_code,
                    'imageable_type' => "App\Models\Product"
                ]);
            }
        });

        self::deleting(function ($product){
            foreach ($product->images as $key => $image) {
                $image->delete();
            }
        });
        
    }
}