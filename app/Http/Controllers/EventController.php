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
use Exception;

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
        $discount = Discount::where('id', $event['fkDiscount']);
        $client = Client::where('id', $event['fkClient']);
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

    public function addEvent(Request $request){
        return DB::transaction(function() use ($request) {

            try{
                if($request['idAddress'] != null){
                    $addAdress = array('id'=>$request['idAddress']);
                }else{
                    $newAddress = $request['address'];
    
                    $addAdress = Address::insert([
                        'state' => $newAddress['state'],
                        'country' => $newAddress['country'],
                        'street' => $newAddress['street'],
                        'number' => $newAddress['number'],
                        'secondaryStreet' => $newAddress['secondayStreet'],
                        'intNumber' => $newAddress['intNumber'],
                        'references' => $newAddress['references']
                    ]);
                }
    
                if($request['idClient'] != null){
                    $addClient = array('id'=>$request['idClient']);
                }else{
    
                    $newClient = $request['client'];
    
                    $addClient = Client::insert([
                        'name' => $newClient['name'],
                        'lastName' => $newClient['lastName'],
                        'phoneNumber' => $newClient['phoneNumber'],
                        'fkAddressId' =>  $addAdress['id']
                    ]);
    
                }
    
                $addDiscount = null;
                $haveDiscount = $request['discount']->count();
                if($haveDiscount != 0){
                    $newDiscount = $request['discount'];
    
                    $addDiscount = Discount::insert([
                        'type' => $newDiscount['type'],
                        'sku' => $newDiscount['sku'],
                        'percentege' => $newDiscount['percentege'],
                        'direct' => $newDiscount['direct']
                    ]);
                    
                }
    
                $newEventPrice = $request['eventPrice'];
    
                $addEventPrice = EventPrice::insert([
                    'total' => $newEventPrice['total'],
                    'iva' => $newEventPrice['iva'],
                    'type' => $newEventPrice['type'],
                    'description' => $newEventPrice['description'],
                    'payNumbers' => $newEventPrice['payNumbers'],
                    'initialPay' => $newEventPrice['initialPay'],
                    'totalCost' => $newEventPrice['totalCost'],
                ]);
    
                $newEvent = $request['event'];
    
                $addEvent = Event::insert([
                    'fkBusinessId' => $newEvent['fkBusinessId'],
                    'name' => $newEvent['name'],
                    'description' => $newEvent['description'],
                    'fkAddresId' => $addAdress['id'],
                    'date' => $newEvent['date'],
                    'deliveryDate' => $newEvent['deliveryDate'],
                    'rcolectdDay' => $newEvent['rcolectdDay'],
                    'hourDelivery' => $newEvent['hourDelivery'],
                    'hourRecolected' => $newEvent['hourRecolected'],
                    'hourDate' => $newEvent['hourDate'],
                    'fkDiscount' => $addDiscount['fkDiscount'],
                    'fkClient' => $addClient['id'],
                    'status' => $newEvent['status'],
                    'comment' => $newEvent['comment'],
                    'fkEventPrice' => $addEventPrice['id'],
                    'auxPhoneNumber' => $newEvent['auxPhoneNumber'],
                    'references' => $newEvent['references'],
                ]);

                DB::commit();

                return response('',201,[]) -> $addEvent;
            } catch (\Exception $error) {
                DB::rollBack();
                return response('',400,[]);
            }
        });
    }
}
