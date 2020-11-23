<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'Address';
    protected $primaryKey = 'id';

    protected $fillable = ['state', 'country', 'street', 'number','secondaryStreet', 'intNumber', 'references', 'fkClientId'];
    public $timestamps = false;
}
