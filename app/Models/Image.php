<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImg;

class Image extends Model
{
    use HasFactory;

    protected $table='images';
    protected $fillable=['imageable_id','imageable_type','src','thumb','alt'];


    public static function uploadImage($img_response,$resize=true){
        if($resize==true){
            $thumbnail = InterventionImg::make($img_response->getPathname())->resize(300, 225, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(null,60)->save(storage_path('app/public/thumbnails/' . $img_response->hashName()));

            $image = InterventionImg::make($img_response->getPathname())->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(null,90)->save(storage_path('app/public/images/' . $img_response->hashName()));

            return [
                'thumb' => $thumbnail,
                'src' => $image
            ];
        }

        return[
            'thumb'=>null,
            'src'=>$img_response->store('images')
        ];
    }

    public static function getAlt($image){
        return trim(str_replace(['.jpeg', '.jpg', '.png'], '', $image->getClientOriginalName()), ' \.');
    }

    public static function boot(){
        parent::boot();

        self::deleted(function ($image){
            if (Storage::disk('public')->exists($image->src)) {
                Storage::disk('public')->delete($image->src);
            }
            if(Storage::disk('public')->exists($image->thumb)) {
                Storage::disk('public')->delete($image->thumb);
            }
        });
    }
}