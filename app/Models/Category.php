<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','description','slug'];

    public static function slugable($category,$slug){
        if($category>0){
            $slug.='-'.$category;
        }
        return $slug;
    }

    // public static function sluged($name,$id){
    //     $slug=Str::slug($name);
    //     $service=Categpr
    // }
}