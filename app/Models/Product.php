<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'pr_name',
        'pr_name_en',
        'pr_image',
        'pr_cost',
        'pr_detail',
        'pr_detail_en',
        'pr_discount',
        'cat_fk',
        'image_hash',
        'pr_cost_new',
        'myCategory'
    ];
    protected $primaryKey = 'pr_id';
    protected $hidden = ['created_at', 'updated_at']; 
    // public $timestamps = false;


    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'pr_fk', 'pr_id');
    }
    public function getFavAttribute()
    {
        $userId = auth()->id(); // الحصول على معرف المستخدم الحالي
        if (!$userId) {
            return 0; // إذا لم يكن هناك مستخدم مسجل الدخول
        }

        return $this->favorites()->where('user_fk', $userId)->exists() ? 1 : 0;
    }


    public function myCategory()
    {
        return $this->belongsTo(Categorie::class, 'cat_fk', 'cat_id');
    }
    protected $appends = ['fav'];


}
