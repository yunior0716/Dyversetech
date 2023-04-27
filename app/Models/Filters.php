<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filters extends Model
{


    public function characteristics()
    {
        return $this->belongsToMany(Characteristics::class, 'filters_characteristics', 'filter_id', 'characteristic_id', 'filter_id', 'characteristics_id')
            ->withPivot('min_value', 'max_value');
    }




    use HasFactory;
}
