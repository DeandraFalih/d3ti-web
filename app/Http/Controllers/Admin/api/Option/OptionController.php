<?php

namespace App\Http\Controllers\admin\api\Option;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Youtube;
use App\Http\Resources\FormatPostResource;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function showYoutube()
    {
        $data_youtube=Youtube::all();

        return [
            'data_youtube' => $data_youtube,
        ];

    }
  
    public function editShowYoutube(Request $request, $youtube_id)
    {
        $youtube = Youtube::findOrFail($youtube_id);
        $youtube->youtube_show = $request->input('show');
        $youtube->save();
    }
  
    public function showGallery()
    {
        $data_gallery=Option::all();

        return [
            'data_gallery' => $data_gallery,
        ];

    }
}
