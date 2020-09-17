<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


    }

    public function list() {

        $data['status'] = 'Success';
        $data['result'] = User::all();
        return response($data, 201)
            ->header('Content-Type','application/json');
    }

    public function register(Request $request) {

        $email = $request->input('email');
        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $password = Hash::make($request->input('password'));
        $token = $request->input('token');

        $state = $request->input('state');
        $state = $request->input('district');
        $city = $request->input('city');

        $data = [
            // 'name' => 'local',
            'mobile' => $mobile,
            'email' => $email,
            'name' => $name,
            'password' => $password
        ];

        if ($token != 'user_register_citystreets_0506') {
            return response()->json([
                'success' => false,
                'message' => 'UnAuthorized Access!!',
                'data' => ''
            ], 201);
        }

        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'unique' => false,
                'message' => 'The email address is already registered. You sure you don\'t have an account?',
                'data' => ''
            ], 201);
            echo '';
        }


        // return $request->all();
        
        $register = User::create($data);
        // return $data;


        if($register) {
            return response()->json([
                'success' => true,
                'unique' => true,

                'message' => 'User Registeration Success',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'unique' => false,
                'success' => false,
                'message' => 'User Registeration Failed!!',
                'data' => ''
            ], 400);
        }
    }

    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email',$email)->first();

        if ($user && Hash::check($password, $user->password)){
            $apiToken = base64_encode(str_random(40));

            $user->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => [
                    'user' => $user,
                    'api_token' => $apiToken
                ]
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'data' => ''
            ], 201);
        }
    }

}
