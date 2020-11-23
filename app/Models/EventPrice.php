<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPrice extends Model
{
    protected $table = 'EventPrice';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 'total', 'iva', 'type', 'description', 'payNumbers', 'initialPay','totalCost'];
    use HasFactory;
}
