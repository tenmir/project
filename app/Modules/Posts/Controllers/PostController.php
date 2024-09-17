<?php

namespace App\Modules\Posts\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Modules\Posts\Requests\EditPostRequest;


class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $skipElements = ($request->page - 1) * $request->count;
        $posts = Post::select('*')->skip($skipElements)->take($request->count)->get();

        return Response::json(
            $posts
        );
    }

    public function editPosts(EditPostRequest $request)
    {
        $updatedPost = Post::where("id" , $request->input('id'))
                ->where('user_id' , $request->user()->id)->update([
                    'title'       => $request->input('title'),
                    'description' => $request->input('description'),
                    'picture'     => $request->input('picture'),
                ]);

        return Response::json(
            $updatedPost
        );
    }

    public function createPost(Request $request)
    {
        $createdPost = Post::create([
            'title' => $request->input('title'),
            "description" => $request->input('description'),
            "picture" => $request->input('picture'),
            "user_id" => $request->user()->id,
        ]);

        return $this->sendSuccess($createdPost);
    }

    public function deletePost(Request $request)
    {
        Post::where('id',$request->input('id'))->where('user_id',$request->user()->id)->delete();

        return Response::json([],204);
    }

    public function makePostTag(Request $request)
    {
        $makePostTag = Post::where('id',$request->input('id'))->update([
            'tags' => $request->input('tags')]);

        return Response::json(
            $makePostTag
        );
    }
}
