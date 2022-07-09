<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'company' => 'required|string',
            'status' => 'required|string',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'company' => $fields['company'],
            'status' => $fields['status'],
            'role' => $fields['role'],
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'message' => 'User registered successfully.',
            'code' => 200
        ]);
    }

    public function login(Request $request) {
        /* echo Hash::make('restinpeace@123');
        exit(); */
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    //Get user details
    public function user(){
        return response([
            'user'=>auth()->user()
        ],200);
    }

    //Get user details
    public function getuser($id){
        $user = User::find($id);
        return response()->json($user);
    }

    //Get all user details
    public function allusers(){
        $users = User::all();
        return response()->json([
            'users' => $users,
            'message' => 'Users',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        if($user){
            $user['status']=0;
            $index='status';
            echo('<script>console.log("'.$user[$index].'");</script>');
            echo('<script>console.log("hello");</script>');
            return response()->json([
                'message' => 'user deleted successfully.',
                'code' => 200
            ]);
        }      
        else{
            return response()->json([
                'message' => 'user not found',
            ]);
        }  
    }
}
