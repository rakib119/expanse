<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function get_category(){
        return $this->hasOne(ProductCategory::class,'cat_id','id');
    }
}
