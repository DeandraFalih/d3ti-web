<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;
    protected $table = 'd3ti_product_categories';
    protected $primaryKey = 'product_categories_id';

    protected $fillable = [
        'product_categories_name', 'product_categories_description', 'product_categories_url'
    ];
}
