<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRent extends Model
{
    protected $table = 'product_rent';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fk_inventary_id',
        'fk_event_id',
        'price',
        'quantity_rent',
        'start_date',
        'endDate'
    ];
    public $timestamps = false;
}
