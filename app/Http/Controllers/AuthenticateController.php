<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        $response = [
            'message' => 'Login Successful'
        ];

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                $response['message'] = 'Invalid Credentials';
                return response()->json($response, 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $response['message'] = 'Could not create Token';
            return response()->json($response, 500);
        }

        // all good so return the token
        $response['token'] = $token;
        return response()->json($response);
    }
}
