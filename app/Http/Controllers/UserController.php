<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Validator;

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

    public function store(Request $request) {
        //validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:3|max:255|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required|min:6|max:255'
        ]);
        //check if there are validation errors
        $errorsArray = $validator->errors()->toArray();
        if (!empty($errorsArray)) {
            return response()->json($errorsArray);
        }

        //create new post and fill the user id
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        //save it and return response
        return response()->json('User created Successfully', 201);
    }

}
