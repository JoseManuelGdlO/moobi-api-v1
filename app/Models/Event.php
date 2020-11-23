<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'Events';
    protected $primaryKey = 'id';

    protected $fillable = [ 
    'fkBusinessId',
    'name',
    'description',
    'fkAddressId',
    'date',
    'deliveryDate',
    'recolectedDate',
    'hourDelivery',
    'hourRecolected',
    'hourDate',
    'fkDiscount',
    'fkClient',
    'status',
    'comment',
    'fkEventPrice',
    'auxPhoneNumber',
    'references'];
    public $timestamps = false;
}
