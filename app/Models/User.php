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
    protected $fillable = ['name','email','password','phone','address','level','active','verification_token'
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
    public function feedbacks(){
        return $this->hasMany(Feedback::class,'user_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class,'user_id');
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
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

    // boot (model events)
    public static function boot(){
        parent::boot();
        self::updating(function($user){
            $image_id=request()->deleted_image;
            $will_deleted_img=Image::find($image_id);
            if (!is_null($will_deleted_img)) {
                    $will_deleted_img->delete();
            }else{

            }
            $image=request()->file('image');
            if(request()->hasFile('image')){
                $user->image()->delete();
                $uploaded=Image::uploadImage($image);
                 Image::create([
                 'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $user->id,
                    'imageable_type' => "App\Models\User"
            ]);
            }
            

        });
    }

}