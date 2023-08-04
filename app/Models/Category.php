<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','description','slug'];


    // Relationship
    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
    // Relationship


    // Scopes
    public function scopeFilter($query,array $filters){
        $query->when($filters['search']??false,function($query,$search){
            return $query->where('name','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%');
        });
    } 
    // Scopes


    // Slug
    public static function sluged($name){
        $slug=Str::slug($name);
        return $slug;
    }
    // Slug
}