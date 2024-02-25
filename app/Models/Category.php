<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
        ->withDefault([
            'name' => 'Parent'
        ]); // if parent null return empty object and you can set value;
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    public static function rull($id = 0) {
        return [
            'name'=> [
                'required',
                'string',
                'min:3',
                'max:255', 
                "unique:categories,name,$id",
            ],

            'parent_id' => 
            'nullable|int|exists:categories,id',
            'image' => 
            'image|mimes:jpg,png|max:1048576|dimensions:min_height=100,min_width=100',
            'status' => 'required|in:active,inactive',
        ];

    }

    public function scopeActive(Builder $builder, $filters) {


        $builder->when($name = $filters['name'] ?? false, function ($builder, $filters)  use($name) {
            $builder->where('name', 'LIKE', "%{$name}%");
        });

        $builder->when($status = $filters['status'] ?? false, function ($builder, $filters)  use($status) {
            $builder->where('status', $status); 
        });

    }
}
