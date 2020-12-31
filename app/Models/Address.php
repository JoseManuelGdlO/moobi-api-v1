<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';

    protected $fillable = ['state', 'country', 'street', 'number','suburb', 'int_number', 'references', 'fk_client_id'];
    public $timestamps = false;
}
