<?php

namespace App\Http\Controllers;

use App\Jobs\ReplyFeedback;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function allFeedback(){
        $data=[
            'title'=>'All Feedback | E-Katalog Khalis Bali Bamboo',
            'feedbacks'=>Feedback::latest()->filter(request(['search','status']))->paginate(15)->withQueryString()
        ];
        return view('admin.feedback.feedback-all',$data);
    }

    public function detailFeedback(Feedback $feedback){
        $data=[
            'title'=>'Feedback Detail | E-Katalog Khalis Bali Bamboo',
            'feedback'=>$feedback
        ];
        return view('admin.feedback.feedback-detail',$data);
    }

    public function patchStatus(Request $request,Feedback $feedback){
        $new_status=$request['status']=='unreviewed'?'reviewed':'unreviewed';
        $updated_feedback=$feedback->update([
            'status'=>$new_status
        ]);
        if($updated_feedback){
            return redirect()->route('manage_feedback.detail')->with('success',"Feedback Status Updated to '".$new_status."'" );
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function deleteFeedback(Feedback $feedback){
    if($feedback->delete()){
                return redirect()->route('manage_feedback.all')->with('success',$feedback->name.'Feedback Deleted Successfully');
            }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');

    }

    public function sendReply(Feedback $feedback,Request $request){
        $details=[
            'name'=>$feedback->user->name,
            'email'=>$request['email'],
            'feedback_message'=>$feedback->message,
            'sent_date'=>$feedback->created_at,
            'reply_message'=>$request['reply_message']
        ];
        ReplyFeedback::dispatch($details);
        $feedback->update([
            'status'=>'replied'
        ]);
        return redirect()->route('manage_feedback.detail',$feedback)->with('success',"We already sent your reply for customer's feedback via email");
       
    }

}