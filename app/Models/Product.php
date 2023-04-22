<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey='product_code';
    protected $keyType='string';
    protected $fillable=['product_code','category_id','name','dimensions','color','materials','description','link_shopee'];

    // relations
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }
    // relations

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

            // dd($img_array);
            // dd(Image::whereIn('id', $img_array)->get());
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
                    'imageable_id' => $product->id,
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