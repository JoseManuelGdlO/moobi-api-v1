<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRent extends Model
{
    protected $table = 'Inventary';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
