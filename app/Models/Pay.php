<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'Pays';
    protected $primaryKey = 'id';
    public $timestamps = false;
}