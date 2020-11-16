<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    use HasFactory;

    protected $table = 'inventary';

    protected $fillable = ['fkBusinessId', 'name', 'cost', 'quantity', 'description', 'sku', 'imageUrl', 'eliminated', 'creationDate', 'update'];

    public $timestamps = false;
}
