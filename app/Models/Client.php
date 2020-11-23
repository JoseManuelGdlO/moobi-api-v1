<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'lastName', 'phoneNumber', 'email', 'fkBusinessId'];
    public $timestamps = false;
}
