<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;
    protected $table = 'd3ti_youtube';
    protected $primaryKey = 'youtube_id';

    protected $fillable = [
        'youtube_video_id', 'youtube_title', 'youtube_show'
    ];
}
