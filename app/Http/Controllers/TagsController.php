<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class TagsController extends Controller
{

    public function makeTag(Request $request){
        $request = Tag::create([
            'name' => $request->input('name'),
            'user_id' => $request->user()->id,
            'post_id' => $request->input('post_id'),
        ]);

    }


}
