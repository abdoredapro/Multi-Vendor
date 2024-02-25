<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = [
        'image','created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = [
        'image_url' 
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id')
        ->withDefault([
            'name' => 'Null',
        ]);
    }

    public function store() {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    

    protected static function booted() {
        static::addGlobalScope('store', function (Builder $builder) {

            $user = Auth::user();
            if($user && $user->id != 2) {
                $builder->where('store_id', $user->store_id);
            }
            
        });

        static::creating(function(Product $product) {
            $product->slug = Str::slug($product->name);
        });
        
    } 



    public function tags() {
        return $this->belongsToMany(
            Tag::class,
            'product_tag', 
            'product_id',
            'tag_id',
            'id', 
            'id'
        );
    }


    public function scopeActive(Builder $builder) {
        $builder->where('status', 'active');
    }


    // Accessors get ... Attribute
    public function getImageUrlAttribute() {
        if(!$this->image) {
            return 'https://sudbury.legendboats.com/resource/defaultProductImage';
        }
        if(Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/'.$this->image);
    }

    public function getSalePercentAttribute() {

        if(!$this->compare_price) return 0;
        return round(100 - (100* $this->price / $this->compare_price), 1);
        
    }

    public function scopeFilter(Builder $builder, $filters) {

        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ],$filters);

        $builder->when($options['status'], function ($builder, $status) {
            $builder->where('status', $status);
        });
        
        $builder->when($options['store_id'], function($builder, $value) {
            $builder->where('store_id', $value);
        });

        $builder->when($options['category_id'], function($builder, $value) {
            $builder->where('category_id', $value);
        });

        $builder->when($options['tag_id'], function($builder, $value) {

            $builder->whereHas('tags', function($builder) use($value) {
                $builder->where('id', $value);
            });
            
        });

    }

}

