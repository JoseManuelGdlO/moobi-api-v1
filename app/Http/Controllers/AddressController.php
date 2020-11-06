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
            'sencondaryStreet' => $request['secondaryStreet'],
            'references' => $request['references'],
            'fkClientId' => $request['fkClientId']
        ]);

        if($response != 0) {
            return response(json_encode($response),201,[]);
        } else {
            return response('error',400,[]);
        }
    }
}
