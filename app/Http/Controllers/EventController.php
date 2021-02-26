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
        $events = Event::where('fk_business_id', $idBusiness);

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
                $businesId = $request['event']['fk_businessId'];
                if($request['idClient'] != null){
                    $addClient = $request['idClient'];
                }else{
    
                    $newClient = new Client($request['client']);
    
                    $addClient = Client::insertGetId([
                        'name' => $newClient['name'],
                        'last_name' => $newClient['last_name'],
                        'phone_number' => $newClient['phone_number'],
                        'email' =>  $newClient['email'],
                        'fk_business_id' => $businesId
                    ]);
    
                }

                if($request['idAddress'] != null){
                    $addAdress = $request['idAddress'];
                }else{
                    $newAddress = new Address($request['address']);
    
                    $addAdress = Address::insertGetId([
                        'state' => $newAddress['state'],
                        'country' => $newAddress['country'],
                        'street' => $newAddress['street'],
                        'number' => $newAddress['number'],
                        'secondaryStreet' => $newAddress['secondaryStreet'],
                        'intNumber' => $newAddress['intNumber'],
                        'references' => $newAddress['references'],
                        'fkClientId' => $addClient
                    ]);
                }
    
                $addDiscount = null;
                if( $request['discount'] != null ){
                    $newDiscount = new Discount($request['discount']);
    
                    $addDiscount = Discount::insertGetId([
                        'type' => $newDiscount['type'],
                        'sku' => $newDiscount['sku'],
                        'percentege' => $newDiscount['percentege'],
                        'direct' => $newDiscount['direct']
                    ]);
                    
                }
    
                $newEventPrice = new EventPrice($request['eventPrice']);
    
                $addEventPrice = EventPrice::insertGetId([
                    'total' => $newEventPrice['total'],
                    'iva' => $newEventPrice['iva'],
                    'type' => $newEventPrice['type'],
                    'description' => $newEventPrice['description'],
                    'payNumbers' => $newEventPrice['payNumbers'],
                    'initialPay' => $newEventPrice['initialPay'],
                    'totalCost' => $newEventPrice['totalCost'],
                ]);
    
                $newEvent = new Event($request['event']);
    
                $addEvent = Event::insertGetId([
                    'fkBusinessId' => $newEvent['fkBusinessId'],
                    'name' => $newEvent['name'],
                    'description' => $newEvent['description'],
                    'fkAddressId' => $addAdress,
                    'date' => $newEvent['date'],
                    'deliveryDate' => $newEvent['deliveryDate'],
                    'recolectedDate' => $newEvent['recolectedDate'],
                    'hourDelivery' => $newEvent['hourDelivery'],
                    'hourRecolected' => $newEvent['hourRecolected'],
                    'hourDate' => $newEvent['hourDate'],
                    'fkDiscount' => $addDiscount,
                    'fkClient' => $addClient,
                    'status' => $newEvent['status'],
                    'comment' => $newEvent['comment'],
                    'fkEventPrice' => $addEventPrice,
                    'auxPhoneNumber' => $newEvent['auxPhoneNumber'],
                    'references' => $newEvent['references'],
                ]);

                $productsRent = $request['products'];

                $errorsProducts = array();
                
                foreach( $productsRent as $product) {
                    $response = ProductRent::insert([
                        'fkInventary' => $product['fkInventary'],
                        'fkEvent' => $addEvent,
                        'price' => $product['price'],
                        'quantityRent' => $product['quantityRent'],
                        'startDate' => $product['startDate'],
                        'endDate' => $product['endDate'],
                    ]);

                    if($response == 0) {
                        $errorsProducts.array_push($product);
                    }
                };

                DB::commit();

                return response(array(['idEvent' => $addEvent, 'errors' => $errorsProducts]),201,[]);
            } catch (\Exception $error) {
                DB::rollBack();
                return response($error,409,[]);
            }
        });
    }
}
