<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoriesLink extends Model
{
    use HasFactory;
    protected $table = 'd3ti_product_categories_link';
    protected $primaryKey = 'product_categories_link_id';

    protected $fillable = [
        'product_id', 'product_categories_id'
    ];
}
