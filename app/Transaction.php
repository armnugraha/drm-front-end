<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    protected $casts = [
        'items'    => 'array',
        'customer' => 'array',
    ];

    protected $fillable = ['invoice', 'items', 'payment', 'total', 'kembalian'];

    public function getRouteKeyName()
    {
        return 'invoice';
    }

    public function getItemsCountAttribute($value)
    {
        $pcsCount = 0;
        foreach ($this->items as $item) {
            $pcsCount += $item['qty'];
        }

        return count($this->items).' Item, '.$pcsCount.' Pcs';
    }

    public function getExchange()
    {
        return $this->payment - $this->total;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
