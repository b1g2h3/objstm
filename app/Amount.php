<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    protected $fillable = ['product_id', 'mnozstvi', 'order_id'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
