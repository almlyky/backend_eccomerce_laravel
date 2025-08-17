<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Categorie extends Model
{
    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'cat_name',
        'cat_name_en',
        'cat_image',
        'products'
    ];
    // public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at']; 
    public function getProductsAttribute()
    {
        return Product::where('cat_fk', $this->cat_id)->get();
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'cat_fk', 'cat_id');
    }
    protected $appends = ['products'];

}
