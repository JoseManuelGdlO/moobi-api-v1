<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    public function addUser(Request $request) {

        $users = User::get()->toArray();

        foreach ($users as $user) {
            if($user['email'] == $request['email'] && $user['fk_business_id'] == $request['fk_business_id']) {
                return response('Email exist',409,[]);
            }
        }

        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $response = User::insertGetId([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'fk_rol_id' => $request['fk_rol_id'],
            'fk_Business_id' => $request['fk_business_id'],
            'password' => $request['password'],
            'is_admin' => false,
            'is_delete' => false,
            'creation_date' => $mytime
        ]);

        if($response != 0) {
            return response(json_encode($response),201,[]);
        } else {
            return response('error',400,[]);
        }
    }

    public function updatePass(Request $request) {

        try {
            $user = User::find($request['id']);
            $user->password = $request['password'];
            $user->save();

            return response(json_encode($user),202,[]);
        } catch (\Exception $e) {
            return response(json_encode($e),409,[]);
        }
    }

    public function deleteUser($id) {

        try {
            $user = User::find($id);
            if($user['is_admin'] == 1) {
                return response('User is Admin',409,[]);
            }

            $user->isDelete = true;
            $user->save();
            
            return response(json_encode($user),200,[]);
        } catch (\Exception $e) {
            return response(json_encode($e),409,[]);
        }
    }
}
