<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'id', 'imagePath'];

    public function categoryImage()
    {
        $image = ($this->imagePath) ?  $this->imagePath : 'category/58x4SYCJN6R0F5UESNBXSxjQdfE36lEPDh3uAY6D.jpeg';

        return '/storage/' . $image;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function path()
    {
       return url("/kategorie/{$this->id}-". Str::slug($this->name));
    }
}
