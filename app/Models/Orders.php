<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Products;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'price',
        'payment'
    ];
    
    public function products(){
        return $this->hasOne(Products::class,'id','product_id');
    }
    public function customer(){
        return $this->hasOne(Customers::class,'id','customer_id');
    }
}
