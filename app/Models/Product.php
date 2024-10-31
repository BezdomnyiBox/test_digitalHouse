<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function characteristics()
    {
        return $this->hasMany(Characteristic::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
