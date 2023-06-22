<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyView extends Model
{
    use HasFactory;
    protected $table = 'd3ti_daily_view';
    protected $primaryKey = 'daily_view_id';

    protected $fillable = [
        'daily_view_title', 'daily_view_count', 'daily_view_type', 'created_at'
    ];
}
