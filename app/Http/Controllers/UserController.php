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
        'password'=>'required|string|min:8',
        'password_confirm'=>'required|same:password'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','An Error Occured During Registration!');
    }
    $validated=$validator->validate();
    $created_user=User::create([
        'name'=>$validated['name'],
        'email'=>$validated['email'],
        'phone'=>$validated['phone'],
        'address'=>$validated['address'],
        'password'=>Hash::make($validated['password']),
        'level'=>'user'
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
        'password'=>'required|string|min:8',
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
        'customers'=>User::where('id','!=',1)->where('level','!=','admin')->latest()->filter(request(['search']))->paginate(15)->withQueryString()
    ];
    return view('admin.customers.customer-all',$data);
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
    if($request->email!=$user->email){
        if(User::where('email',$user->email)->where('id','!=',$user->id)->count()){
            return redirect()->back()->withInput()->with('error', 'This email has been registered, please input another email');
        }else{
            $email_validator = Validator::make($request->all(), [
                'email' => 'required|email:dns|unique:users,email',
            ]);

            if ($email_validator->fails()) {
                return redirect()->back()->withErrors($email_validator)->withInput()->with('error', 'Error Occured, Please Try Again!');
            }
            $validated_email = $email_validator->validate();
            $user->update(['email' => $validated_email['email']]);
        }
    }
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
}