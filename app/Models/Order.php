<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function user() {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest User'
        ]);
    }

    public function products() {
        return $this->belongsToMany(Product::class,'order_items','product_id','id','id')
        ->using(OrderItem::class)
        ->as('order_item') // change the name of pivot table
        ->withPivot([
            'product_name', 'price', 'quantity', 'options'
        ]); // return this in pivot table
    }

    public function delivery() {
        return $this->hasOne(Delivery::class);
    }


    public function addresses() {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress() {
    
        return $this->hasOne(OrderAddress::class)
        ->Where('type', 'billing');
    }

    public function shippinggAddress() {
        return $this->hasOne(OrderAddress::class)
        ->Where('type', 'billing');
    }

    public function items() {
        return $this->hasMany(OrderItem::class, 'order_id');
    }


    public static function booted() {

        static::creating(function(Order $order) {
            $order->number = Order::getLastyear();
        });

    }

    public static function getLastyear() {
        

        $number = Order::whereYear('created_at', date('Y'))->max('number');
        if($number) {
            return $number + 1;
        }
        return date('Y') . '0001';

    }

}
