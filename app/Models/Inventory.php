<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventorys';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'category',
    ];
}
