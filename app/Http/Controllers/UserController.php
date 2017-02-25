<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{
    //
    public function index() {
        try{

            $response = [
                'users' => []
            ];
            $statusCode = 200;
            $users = User::all()->take(9);

            foreach($users as $user){

                $response['users'][] = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'password' => $user->password
                ];
            }


        }catch (Exception $e){
            $statusCode = 404;
        }finally{
            return response()->json($response, $statusCode);
        }
    }


    public function show(User $user) {  //User::find(wildcard);
        return $user;
    }
}
