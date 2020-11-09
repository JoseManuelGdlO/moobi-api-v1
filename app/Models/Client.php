<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
