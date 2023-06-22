<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    use HasFactory;
    protected $table = 'd3ti_event_comment';
    protected $primaryKey = 'event_comment_id';

    protected $fillable = [
        'event_id', 'event_comment_name', 'event_comment_email', 'event_comment_value', 'event_comment_ip', 'event_comment_status', 'created_at'
    ];
}
