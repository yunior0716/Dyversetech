<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phones_Characteristics extends Model
{
    use HasFactory;

    protected $table = 'phones_characteristics';

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function characteristic() {
        return $this->belongsTo(Characteristics::class, 'characteristic_id', 'characteristics_id');
    }

    protected $fillable = [
        'product_id',
        'characteristic_id',
        'characteristic_value'
    ];

    
}
