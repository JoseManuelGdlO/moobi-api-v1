<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Event;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function newClient(Request $request)
    {
        $response = Client::insertGetId([
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'fk_business_id' => $request['fk_business_id'],
        ]);

        if ($response != 0) {
            return response(json_encode($response), 201, []);
        } else {
            return response('error', 400, []);
        }
    }

    public function getClients($idBusiness)
    {
        $response = Client::get()->where('fk_business_id', $idBusiness)->toArray();

        if ($response != 0) {
            return response(json_encode($response), 200, []);
        } else {
            $errorResponse = array(
                "error" => "no clients",
            );
            return response(json_encode($errorResponse), 404, []);
        }
    }

    public function detailClient($idClient)
    {
        try {
            $detailClient = Client::get()->where('id', $idClient)->first();

            $address = Address::get()->where('fk_client_id', $idClient)->toArray();

            $events = Event::get()->where('fk_client_id', $idClient)->toArray();

            $response = array(
                "client" => $detailClient,
                "address" => $address,
                "events" => $events
            );
            
            return response(json_encode($response), 200, []);

        } catch (\Exception $error) {
            $errorResponse = array(
                "error" => "fatal error",
            );
            return response(json_encode($errorResponse), 409, []);
        }

    }
}
