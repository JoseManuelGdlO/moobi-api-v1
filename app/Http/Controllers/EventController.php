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

    public function getProductsRent($idEvent)
    {
        $productsRent = DB::table('inventary')
            ->join('product_rent','fk_inventary_id', '=', 'inventary.id')
            ->select('inventary.name as NombreProducto', 'inventary.quantity as UnidadesDisponibles', 'product_rent.*')
            ->get('');

        $total = $productsRent->count();
        if ($total != 0) {
            return response()->json(
                $productsRent
            );
        } else {
            return response('', 404, []);
        }
    }

    public function getEventsDates()
    {
        $events = Event::get('event_date');

        $total = $events->count();
        if ($total != 0) {
            return response()->json(
                $events
            );
        } else {
            return response('', 404, []);
        }
    }

    public function getAllEvents()
    {
        $events = Event::get();

        $total = $events->count();
        if ($total != 0) {
            return response()->json([
                $events
            ]);
        } else {
            return response('', 404, []);
        }
    }

    public function getEvents($idBusiness)
    {
        $events = Event::where('fk_business_id', $idBusiness)->get();

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
        $event = Event::where('id', $idEvent)->first();

        $total = $event->count();
        if ($total == 0) {
            return response('', 404, []);
        }
       
        $address = Address::where('id', $event['fk_address_id'])->first();
        $discount = Discount::where('id', $event['fk_discount_id'])->first();
        $client = Client::where('id', $event['fk_client_id'])->first();
        $eventPrice = EventPrice::where('id', $event['fk_price_id'])->first();
        $pays = Pay::where('fk_price_event_id', $eventPrice['id'])->get();
        $inventary = ProductRent::where('fk_event_id', $idEvent)->get();

        $result = array(
            'event' => array(
                'detail' => array($event),
                'price' => array(
                    'detail' => $eventPrice,
                    'pays' => $pays
                ),
                'client' => $client,
                'address' => $address,
                'discount' => $discount,
                'rent' => $inventary
            )
        );

        return response()->json([
            $result
        ]);
    }

    public function addEvent(Request $request){
        return DB::transaction(function() use ($request) {

            try{
                $businesId = $request['event']['fk_business_id'];
                if($request['id_client'] != null){
                    $addClient = $request['id_client'];
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
                        'secondary_street' => $newAddress['secondary_street'],
                        'int_number' => $newAddress['int_number'],
                        'references' => $newAddress['references'],
                        'fk_client_id' => $addClient
                    ]);
                }
    
                $addDiscount = null;
                if( $request['discount'] != null ){
                    $newDiscount = new Discount($request['discount']);
    
                    $addDiscount = Discount::insertGetId([
                        'type' => $newDiscount['type'],
                        'sku' => $newDiscount['sku'],
                        'percentege' => $newDiscount['percentege'],
                        'direct_disc' => $newDiscount['direct_disc']
                    ]);
                    
                }
    
                $newEventPrice = new EventPrice($request['event_price']);
    
                $addEventPrice = EventPrice::insertGetId([
                    'total' => $newEventPrice['total'],
                    'iva' => $newEventPrice['iva'],
                    'type' => $newEventPrice['type'],
                    'description' => $newEventPrice['description'],
                    'pay_numbers' => $newEventPrice['pay_numbers'],
                    'initial_pay' => $newEventPrice['initial_pay'],
                    'total_post' => $newEventPrice['total_cost'],
                ]);
    
                $newEvent = new Event($request['event']);
    
                $addEvent = Event::insertGetId([
                    'fk_business_id' => $newEvent['fk_business_id'],
                    'name' => $newEvent['name'],
                    'description' => $newEvent['description'],
                    'fk_address_id' => $addAdress,
                    'date' => $newEvent['date'],
                    'delivery_date' => $newEvent['delivery_date'],
                    'recolected_date' => $newEvent['recolected_date'],
                    'hour_delivery' => $newEvent['hour_delivery'],
                    'hour_decolected' => $newEvent['hour_recolected'],
                    'hour_date' => $newEvent['hour_date'],
                    'fk_discount_id' => $addDiscount,
                    'fk_client_id' => $addClient,
                    'status' => $newEvent['status'],
                    'comment' => $newEvent['comment'],
                    'fk_event_price' => $addEventPrice,
                    'aux_phone_number' => $newEvent['aux_phone_number'],
                    'references' => $newEvent['references'],
                ]);

                $productsRent = $request['products'];

                $errorsProducts = array();
                
                foreach( $productsRent as $product) {
                    $response = ProductRent::insert([
                        'fk_inventary' => $product['fk_inventary'],
                        'fk_event' => $addEvent,
                        'price' => $product['price'],
                        'quantity_rent' => $product['quantity_rent'],
                        'start_Date' => $product['start_date'],
                        'end_date' => $product['end_date'],
                    ]);

                    if($response == 0) {
                        $errorsProducts.array_push($product);
                    }
                };

                DB::commit();

                return response(array(['id_event' => $addEvent, 'errors' => $errorsProducts]),201,[]);
            } catch (\Exception $error) {
                DB::rollBack();
                return response($error,409,[]);
            }
        });
    }
}
