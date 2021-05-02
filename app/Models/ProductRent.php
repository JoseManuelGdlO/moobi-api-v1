<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRent extends Model
{
    protected $table = 'product_rent';
    protected $primaryKey = 'id';

    protected $fillable = [
        'start_date',
        'end_date',
        'price',
        'quantity_rent',
        'fk_inventary_id',
        'fk_event_id'
    ];
    public $timestamps = false;
}
