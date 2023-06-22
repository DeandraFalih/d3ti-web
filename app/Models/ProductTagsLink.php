<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTagsLink extends Model
{
    use HasFactory;
    protected $table = 'd3ti_product_tags_link';
    protected $primaryKey = 'product_tags_link_id';

    protected $fillable = [
        'product_id', 'tags_id'
    ];
}
