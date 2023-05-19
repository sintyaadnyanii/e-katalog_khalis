<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password','phone','address','level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relationship
    public function feedback(){
        return $this->hasMany(Feedback::class,'user_id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class,'user_id');
    }
    // relationship

     // Scopes
    public function scopeFilter($query,array $filters){
        $query->when($filters['search']??false,function($query,$search){
            return $query->where('name','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->orWhere('address','like','%'.$search.'%')->orWhere('phone','like','%'.$search.'%');
        });
    } 
    // Scopes

}