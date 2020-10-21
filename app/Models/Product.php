<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'slug', 'price', 'cost', 'des', 'image', 'amount', 'sale', 'cate_id', 'status',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','cate_id','id');
    }
}
