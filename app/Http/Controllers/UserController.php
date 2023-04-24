<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   public function register(){
    $data=[
        'title'=>'Sign Up | E-Katalog Khalis Bali Bamboo'
    ];
    return view('register',$data);
   }

   public function login(){
    $data=[
        'title'=>'Sign In | E-Katalog Khalis Bali Bamboo'
    ];
    return view('login',$data);
   }

   public function attemptRegister(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required|string|min:8|max:50',
        'email'=>'required|email:dns',
        'phone'=>'required|numeric',
        'address'=>'nullable',
        'password'=>'required|string',
        'password_confirm'=>'required|same:password'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','Oops, An Error Occured During Registration!');
    }
    $validated=$validator->validate();
    $created_user=User::create([
        'name'=>$validated['name'],
        'email'=>$validated['email'],
        'phone'=>$validated['phone'],
        'address'=>$validated['address'],
        'password'=>Hash::make($validated['password']),
    ]);
    if($created_user){
        if($request->redirect_login){
            if(Auth::attempt(['email'=>$validated['email'],'password'=>$validated['password']])){
               if(User::where('email',$validated['email'])->first()->level=='user'){
                    return redirect()->route('main')->with('success','Login Success! <br> Welcome '.auth()->user()->name);
               }
               return redirect()->route('dashboard')->with('success','Login Success! <br> Welcome ' . auth()->user()->name);
            }
            return redirect()->route('login')->with('error','Direct Login Failed! Please Try Using Manual Login');
        }
        return redirect()->route('login')->with('success','New Account Created! Please Login Using Registered Account');
    }
    return redirect()->back()->withInput()->with('error','Account Registration Failed! Please Try Again!');
   }

   public function attemptLogin(Request $request)
   {
    $validator=Validator::make($request->all(),[
        'email'=>'required|email:dns',
        'password'=>'required|string',
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','There is Something Wrong With The Input, Please Try Again!');
    }
    $validated=$validator->validate();
    if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])){
        if(User::where('email',$validated['email'])->first()->level=='user'){
            return redirect()->route('main')->with('success','Login Success! <br> Welcome '.auth()->user()->name);
        }
        return redirect()->route('dashboard')->with('success','Login Success! <br> Welcome ' . auth()->user()->name);
    }
    return redirect()->back()->with('error','Login Failed! Please Try Again!');
   }

   public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You Has Been Logged Out!');
   }

   public function allCustomers(){
    $data=[
        'title'=>'All Customers | E-Katalog Khalis Bali Bamboo',
        'customers'=>User::where('id','!=',1)->where('level','!=','admin')->latest()->get()
    ];
    return view('admin.customers.customers-all',$data);

   }

}