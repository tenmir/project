<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReactionsType;
use Illuminate\Support\Facades\Response;


class ReactionTypeController extends Controller
{
    public function makeReactionType(Request $request){
        $reactionType = ReactionsType::create([
        'type' => $request->input('type'),
       ]);

       return Response::json(
        $reactionType
       );
    }
}
