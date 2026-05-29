<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    protected $primaryKey = 'model_id';

    protected $fillable = [
        'brand_id',
        'model_name',
    ];

    public function brand() {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    
}
