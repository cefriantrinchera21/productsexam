<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_uuid',
        'category_name'
    ];

    public function scopeCategorySearch($query,$search){
        if($search!=''){
            $categories = $query->orderBy('id','DESC')->where('category_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $categories = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $categories;
    }
}
