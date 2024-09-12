<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReactionController extends Controller
{
    public function makeReaction(Request $request){
        $reaction = Reaction::create([
            'reactions_type_id'=>$request->input('reactions_type_id'),
            'post_id'=>$request->input('post_id')
        ]);

        return Response::json(
            $reaction
        );
    }
}
