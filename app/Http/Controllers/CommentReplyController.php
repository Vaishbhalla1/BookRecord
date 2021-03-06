<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\CommentReply;

class CommentReplyController extends Controller
{
    public function store(Request $request, $comment)
    {
        $this->validate($request, ['message' => 'required|max:1000']);
        $commentReply = new CommentReply();
        $commentReply->comment_id = $comment;
        $commentReply->user_id = Auth::id();
        $commentReply->message = $request->message;
        $commentReply->save();

       
        Toastr::success('success', 'The comment replied successfully ;)');
        return redirect()->back();
    }
}
