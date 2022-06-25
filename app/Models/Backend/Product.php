<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable = ['title','slug','specification','price','stock','quantity','flash_key','hot_key','discount','status','rank','image','meta_title','meta_keyword','meta_description','created_by','updated_by'];
    protected $filltable = ['title','slug','status','rank','image','meta_title','meta_keyword','meta_description','created_by','updated_by'];

}
