<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function login(Request $request)
    {
        // Consult the user via email
        $user = User::where('email', $request->email)->first();
        if(!isset($user)){
            return response([
                'message' => 'The email entered is not registered.'
            ], Response::HTTP_CONFLICT);
        }

        // Validate the password with hash()
        if(!Hash::check($request->password, $user->password)){
            return response([
                'message' => 'The password entered is not correct.'
            ], Response::HTTP_CONFLICT);
        }

        return $user->createToken("token-user-" . $user->id . "-". time())->plainTextToken;
    }
}
