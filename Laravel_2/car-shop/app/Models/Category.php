<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'parent_id'];

    // Связь с родительской категорией
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Связь с дочерними категориями
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Связь с товарами
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}