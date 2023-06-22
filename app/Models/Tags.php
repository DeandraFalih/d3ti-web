<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = 'd3ti_tags';
    protected $primaryKey = 'tags_id';

    protected $fillable = [
        'tags_name', 'tags_description'
    ];
}

