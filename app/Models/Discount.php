<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';
    protected $primaryKey = 'id';

    protected $fillable = ['type', 'sku', 'percentege', 'direct_disc'];
    public $timestamps = false;
}
