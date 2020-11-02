<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function getEvents($idBusiness){
        $events = Event::where('fkBusinessId', $idBusiness);

        $total = $events->count();
        if($total != 0){
            return response()->json([
                $events
            ]);
        } else {
            return response('',404,[]);
        }
       
    }
}