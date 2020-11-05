<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\ProductRent;
use App\Models\Address;
use App\Models\Discount;
use App\Models\Client;
use App\Models\EventPrice;
use App\Models\Pay;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function getEvents($idBusiness)
    {
        $events = Event::where('fkBusinessId', $idBusiness);

        $total = $events->count();
        if ($total != 0) {
            return response()->json([
                $events
            ]);
        } else {
            return response('', 404, []);
        }
    }

    public function getDetailEvent($idEvent)
    {
        $event = Event::where('id', $idEvent);

        $total = $event->count();
        if ($total == 0) {
            return response('', 404, []);
        }

        $address = Address::where('id', $event['fkAddressId']);
        $discount = Discount::where('id', $event['fkDiscountId']);
        $client = Client::where('id', $event['fkClientId']);
        $eventPrice = EventPrice::where('id', $event['fkPayId']);
        $pays = Pay::where('fkPayId', $eventPrice['id']);
        $inventary = ProductRent::where('fkEvent', $idEvent);

        $result = array(
            'event' => array(
                'detail' => array($event),
                'price' => array(
                    'detail' => $eventPrice,
                    'pays' => $pays
                ),
                'client' => $client,
                'address' => $address,
                'disccount' => $discount,
                'rent' => $inventary
            )
        );

        return response()->$result;
    }

    public function addEvent($request){
        return DB::transaction(function() use ($request) {
            // $user = User::create([
            //     'username' => $request->post('username')
            // ]);
    
            // // Add some sort of "log" record for the sake of transaction:
            // $log = Log::create([
            //     'message' => 'User Foobar created'
            // ]);
    
            // // Lets add some custom validation that will prohibit the transaction:
            // if($user->id > 1) {
            //     throw AnyException('Please rollback this transaction');
            // }
    
            // return response()->json(['message' => 'User saved!']);
        });
    }
}
