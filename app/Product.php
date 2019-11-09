<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'name', 'barcode', 'pcs_price', 'dozen_price', 'pack_price', 'box_price'];

    public function getPrice($type = 'cash')
    {
        return $this->pcs_price;
    }

    // public function unit()
    // {
    //     return $this->belongsTo(Unit::class);
    // }
}
