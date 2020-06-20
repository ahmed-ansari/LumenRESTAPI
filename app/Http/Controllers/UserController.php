<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Response;
use App\User;


class UserController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function create()
    {
        return public_path();
    }

    public function list() {

        $data['status'] = 'Success';
        $data['result'] = User::all();
        return response($data, 201)
            ->header('Content-Type','application/json');
    }
    

    public function store(Request $request)
    {

    }
    public function show($id)
    {
      
        // $data['result'] = User::find($id);
        // return response($data, 201)
        //     ->header('Content-Type','application/json');

            try {
                $data['result'] = User::findOrFail($id);
                // $user = User::findOrFail($id);
                
                $data['status'] = 'Success';
            } catch(ModelNotFoundException $e) {
                return response('User not found', 404);
            }
                $data['result']->complaint;
    
                return response()->json($data, 200);
    }
    public function edit($id)
    {

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}
