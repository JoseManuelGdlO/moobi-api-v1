<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';

    protected $fillable = [ 
            'name_event',
            'description',
            'event_date',
            'event_delivery',
            'event_recolected',
            'hour_delivery',
            'hour_recolected',
            'hour_date',
            'aux_phone_number',
            'references',
            'status',
            'comment',
            'fk_business_id',
            'fk_price_id',
            'fk_discount_id',
            'fk_client_id',
            'fk_address_id'
        ];
    public $timestamps = false;
}
