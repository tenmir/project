<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ProfileController extends Controller
{
    public function createProfile(Request $request)
    {
        $profile = Profile::create ([
            'user_id'=> auth()->user()->id,
            'first_name'=>$request->input('first_name'),
            'second_name'=>$request->input('second_name'),
            'bio'=>$request->input('bio')
        ]);
        return Response::json(
            $profile
        );
    }

    public function show()
    {
        $profile = auth()->user();
        return $profile;
    }

    public function profileUpdate(Request $request)
    {
        $profile = Profile::where('user_id',auth()->user()->id)->update ([
            'first_name'=>$request->input('first_name'),
            'second_name'=>$request->input('second_name'),
            'bio'=>$request->input('bio')
        ]);

        return Response::json(
            $profile
        );
    }
}
