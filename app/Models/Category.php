<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','description','slug'];

    public static function slugable($category,$slug){
        if($category>0){
            $slug .= '-'.$category;
        }
        return $slug;
    }

    public static function sluged($name,$id){
        $slug=Str::slug($name);
        $category=Category::where('slug',$slug)->get()->count();
        if(intval($id)!=0){
            if(Category::where('slug',$slug)->where('id','!=', $id)->get()->count()){
                $slug=Category::slugable($category,$slug);
            }
        }else{
            $slug=Category::slugable($category,$slug);
        }

        return $slug;
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}