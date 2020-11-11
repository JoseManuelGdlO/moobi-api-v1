<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPrice extends Model
{
    protected $table = 'EventsPrice';
    protected $primaryKey = 'id';
    public $timestamps = false;use HasFactory;
}
