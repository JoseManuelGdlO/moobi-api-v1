<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPrice extends Model
{
    protected $table = 'event_price';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
            'total',
            'tax',
            'type',
            'description',
            'pay_numbers',
            'initial_pay',
            'total_cost'
        ];
    use HasFactory;
}
