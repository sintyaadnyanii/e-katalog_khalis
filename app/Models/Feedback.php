<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable=['user_id','rating','status','message'];


    // relationship
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    // relationship

    // scopes
    public function scopeFilter($query,array $filters){
        $query->when($filters['search']??false,function($query,$search){
            return $query->WhereHas('user',function($query)use($search){
                $query->where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%');
            });
        });
    } 
    // scopes
}