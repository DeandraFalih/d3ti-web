<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'd3ti_product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_title', 'product_featured_image', 'product_content', 'product_excerpt', 'product_release_date', 'product_owner', 'product_status', 'product_date', 'product_author', 'product_link', 'product_meta', 'product_view'
    ];
}
