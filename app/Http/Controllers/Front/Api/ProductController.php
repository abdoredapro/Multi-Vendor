<?php

namespace App\Http\Controllers\Front\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    public function index(Request $request)
    {
        $products =  Product::filter($request->query())
        ->with('category:id,name', 'store:id,name', 'tags:id,name')
        ->paginate();


        return ProductResource::collection($products); // return data collection
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);


        $user = $request->user();
        if(!$user->tokenCan('product.create')) {
            abort(403, 'Not Allowed');
        }

        $product = Product::create( $request->all() );

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
        return $product
        ->load('category:id,name', 'store:id,name', 'tags:id,name');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);

        $user = $request->user();
        if(!$user->tokenCan('product.create')) {
            abort(403, 'Not Allowed');
        }


        $product->update( $request->all() );

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::guard('sanctum')->user();
        if(!$user->tokenCan('product.create')) {
            abort(403, 'Not Allowed');
        }
        Product::destroy($id);
        return [
            'message' => 'Product deleted successfully'
        ];
    }
}
