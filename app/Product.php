<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;

class Product extends Model
{
    protected $fillable = ['id','name', 'category_id', 'hmotnost'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function amounts()
    {
        return $this->hasMany(Product::class);
    }

    public function path()
    {
       return url("/produkt/{$this->id}-". Str::slug($this->name));
    }

    public function search($id)
    {
       return DB::table('amounts')
       ->where('product_id', 'like', $id)
       ->get();
    }
}

