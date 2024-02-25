<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function Products() {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }


}
