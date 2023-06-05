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
            'feedbacks'=>Feedback::latest()->filter(request(['search']))->paginate(15)->withQueryString()
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

    // public function updateFeedback(Feedback $feedback){
    //     $data=[
    //         'title'=>'Feedback Update | E-Katalog Khalis Bali Bamboo',
    //         'users'=>User::latest()->get(),
    //         'feedback'=>$feedback
    //     ];
    //     return view('admin.feedback.feedback-update',$data);
    // }

    public function detailFeedback(Feedback $feedback){
        $data=[
            'title'=>'Feedback Detail | E-Katalog Khalis Bali Bamboo',
            'feedback'=>$feedback
        ];
        return view('admin.feedback.feedback-detail',$data);
    }

    public function storeFeedback(Request $request){
        $validator=Validator::make($request->all(),[
            'user_id'=>'required|integer',
            'rating'=>'required|integer',
            'message'=>'nullable|string',
            'status'=>'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','There must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $created_feedback=Feedback::create([
            'user_id'=>$validated['user_id']==0?1:$validated['user_id'],
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
        $updated_feedback=$feedback->update([
            'status'=>$request['status']?0:1,
        ]);
        if($updated_feedback){
            return redirect()->route('manage_feedback.all')->with('success','Feedback Updated Successfully');
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