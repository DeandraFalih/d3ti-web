<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTagsLink extends Model
{
    use HasFactory;
    protected $table = 'd3ti_post_tags_link';
    protected $primaryKey = 'post_tags_link_id';

    protected $fillable = [
        'post_id', 'tags_id'
    ];
}
