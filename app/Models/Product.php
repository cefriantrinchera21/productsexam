<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_uuid',
        'product_name',
        'category_id'
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeProductSearch($query,$search){
        if($search!=''){
            $products = $query->orderBy('id','DESC')->where('product_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $products = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $products;
    }
}
