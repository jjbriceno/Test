<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'currency_id', 'tax_cost', 'manufacturing_cost'];

    public function currencies()
    {
        return $this->belongsToMany(Currency::class);
    }
}
