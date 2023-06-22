<?php

namespace App\Http\Controllers\Admin\api\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Http\Resources\FormatPostResource;
use Illuminate\Support\Facades\DB;


class TagsController extends Controller
{
    public function showTags()
    {
        $data_tags=Tags::all();

        return [
            'data_tags' => $data_tags,
        ];

    }

    public function createTagsProcess(Request $request)
    {
        $receive = Tags::create([
            'tags_name' => $request->name,
            'tags_description' => $request->description,
        ]);
    }


    public function editTagsProcess(Request $request, $tags_id)
    {
        $data_post_tags = Tags::findOrFail($tags_id);
      
        $data_post_tags->update([
            'tags_name' => $request->name,
            'tags_description' => $request->description,
        ]);
    }

    public function deleteTags($tags_id)
    {
        $data_tags = Tags::findOrFail($tags_id);
        $data_tags->delete();
    }

}
