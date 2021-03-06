<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'nazev',
        'ulice',
        'mesto',
        'psc',
        'zeme',
        'ic',
        'dic'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
