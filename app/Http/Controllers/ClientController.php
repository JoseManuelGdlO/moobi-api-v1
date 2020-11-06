<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function newClient(Request $request) {
        $response = Client::insertGetId([
            'name' => $request['name'],
            'lastName' => $request['lastName'],
            'phoneNumber' => $request['phoneNumber'],
            'email' => $request['email'],
            'fkBusinessId' => $request['fkBusinessId'],
        ]);
        
        if($response != 0) {
            return response(json_encode($response),201,[]);
        } else {
            return response('error',400,[]);
        }
   }
}
