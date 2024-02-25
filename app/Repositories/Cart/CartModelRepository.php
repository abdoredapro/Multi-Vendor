<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRepository implements CartRepository 
{

    protected $item;
    public function __construct()
    {
        $this->item = collect([]); 
    }

    public function get() : Collection
    {

        if(!$this->item->count()) {
            $this->item = Cart::with('product')->get();
        }

        return $this->item;
    }

    public function add(Product $product, $quantity = 1) {

        $item = Cart::Where('product_id', $product->id)
        ->first();

        if(!$item) {
            $cart = Cart::create([
                // 'cookie_id' => $this->getCookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

            $this->get()->push($cart);
            return $cart;
        }

        return $item->increment('quantity', $quantity);
        
    }

    public function update($id, $quantity = 1) {

        Cart::where('id', $id)
        ->update([
            'quantity' => $quantity,
        ]);
        
    }

    public function delete($id) {
        Cart::where('id', $id)->delete();
    }

    public function empty() {
        
        Cart::query()->delete();
    }

    public function total() : float {

        return $this->get()->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }

    

}