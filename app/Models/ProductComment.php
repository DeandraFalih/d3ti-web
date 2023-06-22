<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;
    protected $table = 'd3ti_product_comment';
    protected $primaryKey = 'product_comment_id';

    protected $fillable = [
        'product_id', 'product_comment_name', 'product_comment_email', 'product_comment_value', 'product_comment_ip', 'product_comment_status', 'created_at'
    ];
}
