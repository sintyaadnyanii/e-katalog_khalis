<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function allFeedback(){
        $data=[
            'title'=>'All Feedback | E-Katalog Khalis Bali Bamboo',
            'feedbacks'=>Feedback::latest()->get(),
        ];
        return view('admin.feedback.feedback-all',$data);
    }
    public function createFeedback(){
        $data=[
            'title'=>'Add Feedback | E-Katalog Khalis Bali Bamboo',
            'users'=>User::latest()->get()
        ];
        return view('admin.feedback.feedback-create',$data);
    }

    public function updateFeedback(Feedback $feedback){
        $data=[
            'title'=>'Add Feedback | E-Katalog Khalis Bali Bamboo',
            'users'=>User::latest()->get(),
            'feedback'=>$feedback
        ];
        return view('admin.feedback.feedback-update',$data);
    }

    public function storeFeedback(Request $request){
        $validator=Validator::make($request->all(),[
            'user_id'=>'required|integer',
            'rating'=>'required|integer',
            'message'=>'required|string',
            'status'=>'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','Oops, there must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $created_feedback=Feedback::create([
            'user_id'=>$validated['user_id'],
            'rating'=>$validated['rating'],
            'message'=>$validated['message'],
            'status'=>$validated['status']=='show'?1:0,
        ]);
        if($created_feedback){
            return redirect()->route('manage_feedback.all')->with('success','New Feedback Created Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }
    public function patchFeedback(Request $request,Feedback $feedback){
        $validator=Validator::make($request->all(),[
            'user_id'=>'required|integer',
            'rating'=>'required|string',
            'message'=>'required|string',
            'status'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','Oops, there must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $updated_feedback=$feedback->update([
            'user_id'=>$validated['user_id'],
            'rating'=>$validated['rating'],
            'message'=>$validated['message'],
            'status'=>$validated['status']=='show'?1:0,
        ]);
        if($updated_feedback){
            return redirect()->route('manage_feedback.all')->with('success','New Feedback Created Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function deleteFeedback(Feedback $feedback){
    if($feedback->delete()){
                return redirect()->route('manage_feedback.all')->with('success',$feedback->name.'Feedback Deleted Successfully');
            }
            return redirect()->back()->with('error','Error Occured, Please Try Again!');

        }

}