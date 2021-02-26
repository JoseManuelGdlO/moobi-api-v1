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
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'address' => $request['address'],
            'state' => $request['state'],
            'name_business' => $request['name_business'],
            'description_business' => $request['description_business'],
            'media_type' => $request['media_type'],
            'creation_date' => $mytime,
            'available_time' => $request['available_time'],
        ]);

        if ($response != 0) {
            return response(json_encode($response), 201, []);
        } else {
            return response('error', 400, []);
        }
    }
}
