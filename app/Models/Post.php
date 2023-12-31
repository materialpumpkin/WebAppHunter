<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
    'title',
    'body',
    'url',
    'category_id',
    'user_id',
    'ogp_url'
    ];
    
    public function getPaginateByLimit(int $limit_count = 5)
      {
      return $this::with('categories')->orderBy('updated_at', 'DESC')->paginate($limit_count);
      }
    public function categories()
      {
      return $this->belongsToMany(Category::class,'post_category');
      }
}