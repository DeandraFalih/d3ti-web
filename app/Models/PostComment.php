<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $table = 'd3ti_post_comment';
    protected $primaryKey = 'post_comment_id';

    protected $fillable = [
        'post_id', 'post_comment_name', 'post_comment_email', 'post_comment_value', 'post_comment_ip', 'post_comment_status', 'created_at'
    ];
}
