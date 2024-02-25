<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Exceptions\InvalidOrderException;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart) {
        
        if($cart->get()->count() == 0) {
            throw new InvalidOrderException('Cart empty');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'country' => Countries::getNames('en'),
        ]);
    }

    public function store(Request $request, CartRepository $cart) {

        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255']
        ]);

        DB::beginTransaction();
        try {

            $stores = $cart->get()->groupBy('product.store_id')->all();


            foreach($stores as $store_id => $cart_item) {

                $order = Order::create([
                    'store_id' => $store_id, 
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
    
                ]);
            }
            

            foreach($cart_item as $item) {
                // dd($item);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);

            }

            foreach($request->post('addr') as $type => $address) {
                $address['type'] = $type;
                $order->addresses()->create($address);
            }

            event(new OrderCreated($order));


            DB::commit();

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('orders.payment.create', $order->id);
    }
}
