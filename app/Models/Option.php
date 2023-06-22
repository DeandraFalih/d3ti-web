<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = 'd3ti_options';
    protected $primaryKey = 'd3ti_options_id';

    protected $fillable = [
        'd3ti_options_name', 'd3ti_options_value'
    ];
}
