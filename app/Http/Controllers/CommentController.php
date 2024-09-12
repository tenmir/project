<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    public function createComment(Request $request){
        $createdComment = Comment::create([
            'text' => $request->input('text'),
            'user_id' => $request->user()->id,
            'post_id' => $request->input('post_id'),
        ]);

        return Response::json(
            $createdComment
        );
    }

    public function getComments(Request $request){
        $comment = Comment::where('post_id',$request->input('post_id'))->get();

        return Response::json(
            $comment
        );
    }


}
