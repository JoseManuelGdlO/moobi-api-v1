<?php

namespace App\Http\Controllers;

use App\Models\Onboarding;

class AplicationController extends Controller
{
    public function getOnboarding()
    {
        $response = Onboarding::get()->toArray();

        if ($response != 0) {
            return response(json_encode($response), 200, []);
        } else {
            $errorResponse = array(
                "error" => "no onboarding",
            );
            return response(json_encode($errorResponse), 404, []);
        }
    }
}
