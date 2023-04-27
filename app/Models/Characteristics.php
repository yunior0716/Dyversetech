<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristics extends Model
{


    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'filters_characteristics', 'characteristic_id', 'filter_id', 'characteristics_id', 'filter_id')
            ->withPivot('min_value', 'max_value');
    }

public function products()
{
    return $this->belongsToMany(Product::class, 'phones_characteristics', 'characteristic_id', 'product_id')
        ->withPivot('characteristic_value');
}

    use HasFactory;
}
