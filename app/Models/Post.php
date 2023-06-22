<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'd3ti_post';
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'post_title', 'post_featured_image', 'post_content', 'post_excerpt', 'post_status', 'post_date', 'post_author', 'post_link', 'post_meta', 'post_view'
    ];

    public function cat($categoryName)
    {
        return $this->where('post_status', '=', 'Published')
            ->whereHas('categories', function ($query) use ($categoryName) {
                $query->where('d3ti_post_categories.post_categories_name', $categoryName);
            })
            ->orderBy('post_id', 'desc');
    }

}
