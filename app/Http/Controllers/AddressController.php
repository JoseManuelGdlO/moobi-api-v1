<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function addAddress(Request $request) {
        $response = Address::insertGetId([
            'state' => $request['state'],
            'country' => $request['country'],
            'street' => $request['street'],
            'number' => $request['number'],
            'sencondary_street' => $request['secondary_street'],
            'references' => $request['references'],
            'fk_client_id' => $request['fk_client_id']
        ]);

        if($response != 0) {
            return response(json_encode($response),201,[]);
        } else {
            return response('error',400,[]);
        }
    }
}
