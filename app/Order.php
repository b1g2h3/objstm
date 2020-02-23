<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['user_id', 'description', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getstatusAttribute($attribute)
    {
        return [
            0 => 'Rozpracovaná',
            1 => 'Potvrzena',
        ][$attribute];
    }

    public function amounts()
    {
        return $this->belongsToMany(Amount::class);
    }

    

}
