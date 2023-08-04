<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('same_words',function($attribute,$value,$parameters,$validator){
            //memeriksa apakah input terdiri dari maksimal kata yang ditentukan dengan memisahkan kata berdasarkan spasi.
            $same_words=intval($parameters[0]??1);
            $words=explode(' ',$value);
            return count($words)==$same_words;
        });
        Validator::replacer('same_words',function($message,$attribute,$rule,$parameters){
            return str_replace(':attribute',$attribute,"The :attribute field must contain {$parameters[0]} word(s).");
        });
    }
}