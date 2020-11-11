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
            if($user['email'] == $request['email'] && $user['fkBusiness'] == $request['fkBusinessId']) {
                return response('Email exist',409,[]);
            }
        }

        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $response = User::insertGetId([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
            'fkRol' => $request['fkRolId'],
            'fkBusiness' => $request['fkBusinessId'],
            'password' => $request['password'],
            'isAdmin' => false,
            'isDelete' => false,
            'creationDate' => $mytime
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
            if($user['isAdmin'] == 1) {
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
