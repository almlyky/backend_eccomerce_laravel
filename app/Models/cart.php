<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class cart extends Model
{
    protected $primaryKey = 'cart_id';
    // protected $table = 'carts';
    protected $hidden = ['created_at', 'updated_at']; 
   protected $fillable = [
        'user_fk',
        'pr_fk',
        'quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'pr_fk','pr_id');
    }
}
