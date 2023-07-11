<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEmail;
use App\Jobs\VerifyEmail;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        'email'=>'required|email:dns|unique:users,email',
        'phone'=>'required|numeric',
        'address'=>'nullable',
        'password'=>'required|string|min:8',
        'password_confirm'=>'required|same:password'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error',"There's something wrong with the input! Please try again!");
    }
    $validated=$validator->validate();
    $token=Str::random(50);
    $created_user=User::create([
        'name'=>$validated['name'],
        'email'=>$validated['email'],
        'phone'=>$validated['phone'],
        'address'=>$validated['address'],
        'password'=>Hash::make($validated['password']),
        'level'=>'user',
        'verification_token'=>$token
    ]);
    if($created_user){
        $details=[
            'email'=>$validated['email'],
            'name'=>$validated['name'],
            // 'url'=>request()->getHttpHost().'/register/verify/'.$token
            'url'=>'http://127.0.0.1:8000/register/verify/'.$token
        ];
        
        VerifyEmail::dispatch($details);
        return redirect()->route('register')->with('success','We already sent email verification message. Please verify your email address to continue');
    }
    return redirect()->back()->withInput()->with('error','Account Registration Failed! Please Try Again!');
   }

   public function verify($verification_token){
    $user=User::where('verification_token',$verification_token)->first();
    if($user){
        $user->update(['active'=>1]);
        return redirect()->route('login')->with('success','Email Verified. Please Login Using Your Activated Account!');
    }
    return redirect()->route('register')->with('error','Verification token is invalid, please try again!');
   }

   public function attemptLogin(Request $request)
   {
    $validator=Validator::make($request->all(),[
        'email'=>'required|email:dns',
        'password'=>'required|string|min:8',
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error',"There's Something Wrong With The Input! Please Try Again!");
    }
    $validated=$validator->validate();
    if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password'],'active'=>1])){
        if(User::where('email',$validated['email'])->first()->level=='user'){
            return redirect()->route('main')->with('success','Login Success! Welcome '.auth()->user()->name);
        }
        return redirect()->route('dashboard')->with('success','Login Success! Welcome ' . auth()->user()->name);
    }
    return redirect()->back()->withInput()->with('error','Login Failed! Please Check Your Input or Verify Your Account First, Then Try Again!');
   }

   public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You Has Been Logged Out!');
   }

   public function updateProfile(){
    $data=[
        'title'=>'Edit Profile | E-Katalog Khalis Bali Bamboo',
        'user'=>Auth::user()
    ];
    return view('update-profile',$data);
   }

   public function updatePassword(){
    $data=[
        'title'=>'Change Password | E-Katalog Khalis Bali Bamboo'
    ];
    return view('update-password',$data);
   }

   public function patchProfile(Request $request, User $user){
    $validator=Validator::make($request->all(),[
        'name'=>'required|string|min:8|max:50',
        'phone'=>'required|numeric',
        'address'=>'nullable'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','An Error Occured During Updating!');
    }
    $validated=$validator->validate();
    $user->touch();
    $updated_user=$user->update([
        'name'=>$validated['name'],
        'phone'=>$validated['phone'],
        'address'=>$validated['address']
    ]);
    if($updated_user){
        if(Auth::user()->level=='admin'){
          return redirect()->route('dashboard')->with('success','Your Profile Has Been Updated Successfully');  
        }
        return redirect()->route('main')->with('success','Your Profile Has Been Updated Successfully'); 
    }
    return redirect()->back()->withInput()->with('error','Update Profile Failed! Please Try Again!');

   }

   public function patchPassword(Request $request){
    $validator=Validator::make($request->all(),[
        'old_password'=>'required|string|min:8',
        'new_password'=>'required|string|min:8',
        'confirm_password'=>'required|same:new_password',
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','There is Something Wrong With The Input, Please Try Again!');
    }
    $validated=$validator->validate();
    if(Hash::check($validated['old_password'], auth()->user()->password)){
        $updated_password=User::where('id',auth()->user()->id)->update([
        'password'=>Hash::make($validated['new_password'])
        ]);
        if($updated_password){
            return redirect()->route('dashboard')->with('success','Your Password Has Been Changed Successfully');
        }
        return redirect()->back()->withInput()->with('error','Change Password Failed! Please Try Again!');
    }
    return redirect()->back()->with('error',"Password Doesn't Match, Please Try Again!");

   }

   public function allCustomers(){
    $data=[
        'title'=>'All Customers | E-Katalog Khalis Bali Bamboo',
        'customers'=>User::whereNot('id',1)->whereNot('level','admin')->where('active',1)->latest()->filter(request(['search']))->paginate(15)->withQueryString()
    ];
    return view('admin.customers.customer-all',$data);
   }

    public function detailCustomer(User $user){
    $data=[
        'title'=>'Detail Customer | E-Katalog Khalis Bali Bamboo',
        'user'=>$user,
        'wishlists'=>Wishlist::where('user_id',$user->id)->latest()->paginate(15)
    ];
    return view('admin.customers.customer-detail',$data);
   }

   public function sendNotification(){
    $users=User::where('level','user')->where('active',1)->get();
        foreach($users as $user){
            ProcessEmail::dispatch($user);
        }
    return redirect()->back()->with('success','Emails Have Been Sent to All Customers');
   }
}