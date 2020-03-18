<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'id', 'imagePath'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function path()
    {
       return url("/kategorie/{$this->id}-". Str::slug($this->name));
    }
}
