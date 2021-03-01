<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
        'email',
        'fk_business_id'
    ];
    public $timestamps = false;
}
