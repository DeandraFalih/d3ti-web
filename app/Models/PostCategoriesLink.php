<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoriesLink extends Model
{
    use HasFactory;
    protected $table = 'd3ti_post_categories_link';
    protected $primaryKey = 'post_categories_link_id';

    protected $fillable = [
        'post_id', 'post_categories_id'
    ];
}
