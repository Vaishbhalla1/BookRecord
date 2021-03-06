<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post)
    {
        $this->validate($request, ['message' => 'required|max:1000']); //change comment field to message
        $comment = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->message = $request->message; //change comment field to message
        $comment->save();

    
        Toastr::success('success', 'The comment created successfully ;)');
        return redirect()->back();
    }
}
