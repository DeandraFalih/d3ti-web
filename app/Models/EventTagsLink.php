<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTagsLink extends Model
{
    use HasFactory;
    protected $table = 'd3ti_event_tags_link';
    protected $primaryKey = 'event_tags_link_id';

    protected $fillable = [
        'event_id', 'tags_id'
    ];
}
