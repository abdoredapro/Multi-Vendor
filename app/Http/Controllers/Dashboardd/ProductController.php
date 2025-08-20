<?php

namespace App\Http\Controllers\Dashboardd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Auth\Access\Response;
use Illuminate\Cache\TagSet;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any', Product::class);
        
        $products = Product::with('category')->paginate();
        return view('dashboard.Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        // Policy 
        $this->authorize('view', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $tag = implode(',',$product->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit', compact('product', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        $product->update( $request->except('tags') );

        $tags = json_decode($request->tags);

        // GET all tags

        $tag_ids = [];

        foreach($tags as $tag_name) {
            $slug = Str::slug($tag_name);
            $tag = Tag::where('slug', $slug)->first();

            if(!$tag) {
                $tag = Tag::create([
                    'name' => $tag_name,
                    'slug' => $slug
                ]);
            }
            $tag_ids[] = $tag->id;
            
        }


        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
    }
}
