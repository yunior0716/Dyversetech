<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function model() {
        return $this->belongsTo(Models::class, 'model_id', 'model_id');
    }

    public function operator() {
        return $this->belongsTo(Operators::class, 'operator_id', 'operator_id');
    }

    public function phoneCharacteristics()
{
    return $this->hasMany(Phones_Characteristics::class, 'product_id', 'id');
}


public function characteristics()
{
    return $this->belongsToMany(Characteristics::class, 'phones_characteristics', 'product_id', 'characteristic_id', 'id', 'characteristics_id')
        ->withPivot('characteristic_value');
}


public function carts()
{
    return $this->hasMany(Cart::class, 'product_id', 'id');
}

}
