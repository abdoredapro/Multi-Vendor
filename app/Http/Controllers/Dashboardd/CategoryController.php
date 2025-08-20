<?php

namespace App\Http\Controllers\Dashboardd;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    
    public function index()
    {

        Gate::authorize('category.view'); 

        $request = request();

        $categories = Category::with('parent')
        ->withCount('products')->orderBy('name')->paginate(10);


        return view('dashboard.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_parent = Category::all();
        $category = new Category();
        return view('dashboard.category.create',compact('category', 'all_parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $cleaning_data = $request->validate(Category::rull());
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $data = $request->except('image');

        if($request->hasFile('image')) {
            $file = $request->file('image'); // UploadedFile Object
            $imageName = 
            time() . Str::random(5) . "." . $file->getClientOriginalExtension();
            $path = $file->storeAs('upload', $imageName , [
                'disk'=> 'public',
            ]); 

            $data['image'] = $path;
        }

        $category = Category::create($data);

        return redirect()->route('dashboard.category.index')->with(
            ['success' => 'Category Addedd Successfully']
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.category.products', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $all_parent = Category::where('id', '<>', $category->id)
        ->whereNull('parent_id')
        ->orWhere('id', '<>', $category->id)
        ->get();
    
        return view('dashboard.category.show', compact('category','all_parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)

    {
        $category = Category::findOrFail( $id);

        $cleaning_data = $request->validate(Category::rull($id));

        $old_image = $category->image;

        $data = $request->except('image');

        if($request->hasFile('image')) {
            $file = $request->file('image'); // UploadedFile Object
            
            $path = $file->store('upload', [
                'disk'=> 'public',
            ]); 
            $data['image'] = $path;
        }

        if($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }


        $category->update($data);

        return redirect()->route('dashboard.category.index')->with(
            ['info' => 'Category Edited Successfully']
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
        
        $category->delete();

        return redirect()->route('dashboard.category.index')->with(
            ['success' => 'Category Deleted Successfully']
        );
    }


    public function trash() {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.category.trash', compact('categories'));

    }

    public function restore(Request $request, $id) {
        $categories = Category::withTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route('dashboard.category.trash')->with([
            'trash' => 'Category Restoried'
        ]);

    }

    public function forceDelete($id) {
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->forceDelete();

        if($category->image) {
            Storage::disk('public')->delete($category->image);
        }


        return redirect()->route('dashboard.category.trash')->with([
            'delete' => 'Category deleted'
        ]); 

    }
}
