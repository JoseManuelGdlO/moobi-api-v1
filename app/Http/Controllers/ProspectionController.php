<?php

namespace App\Http\Controllers;

use App\Models\Prospection;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProspectionController extends Controller
{
    public function addProspection(Request $request) {

        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $response = Prospection::insertGetId([
            'name' => $request['name'],
            'phoneNumber' => $request['phoneNumber'],
            'email' => $request['email'],
            'address' => $request['address'],
            'state' => $request['state'],
            'nameBusiness' => $request['nameBusiness'],
            'descriptionBusiness' => $request['descriptionBusiness'],
            'mediaType' => $request['mediaType'],
            'creationDate' => $mytime,
            'availableTime' => $request['availableTime'],
        ]);

        if ($response != 0) {
            return response(json_encode($response), 201, []);
        } else {
            return response('error', 400, []);
        }
    }
}
