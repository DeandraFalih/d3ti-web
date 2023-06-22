<?php

namespace App\Http\Controllers\Admin\api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostComment;
use App\Models\EventComment;
use App\Models\ProductComment;
use App\Http\Resources\FormatPostResource;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function showPostComment()
    {
        $data_post_comment = DB::table('d3ti_post_comment')
            ->join('d3ti_post', 'd3ti_post_comment.post_id', '=', 'd3ti_post.post_id')
            ->select('d3ti_post_comment.*', 'd3ti_post.post_title')
            ->get();

        return [
            'data_post_comment' => $data_post_comment,
        ];
    }

    public function managePostCommentStatus(Request $request, $post_comment_id)
    {
        $db_post_comment = PostComment::findOrFail($post_comment_id);
        
        $data = [
            'post_comment_status' => $request->status,
        ];

        //Update the data
        $db_post_comment->update($data);
    }

    public function showEventComment()
    {
        $data_event_comment = DB::table('d3ti_event_comment')
            ->join('d3ti_event', 'd3ti_event_comment.event_id', '=', 'd3ti_event.event_id')
            ->select('d3ti_event_comment.*', 'd3ti_event.event_title')
            ->get();

        return [
            'data_event_comment' => $data_event_comment,
        ];
    }

    public function manageEventCommentStatus(Request $request, $event_comment_id)
    {
        $db_event_comment = EventComment::findOrFail($event_comment_id);

        $data = [
            'event_comment_status' => $request->status,
        ];

        // Update the data
        $db_event_comment->update($data);
    }

    public function showProductComment()
    {
        $data_product_comment = DB::table('d3ti_product_comment')
            ->join('d3ti_product', 'd3ti_product_comment.product_id', '=', 'd3ti_product.product_id')
            ->select('d3ti_product_comment.*', 'd3ti_product.product_title')
            ->get();

        return [
            'data_product_comment' => $data_product_comment,
        ];
    }

    public function manageProductCommentStatus(Request $request, $product_comment_id)
    {
        $db_product_comment = ProductComment::findOrFail($product_comment_id);

        $data = [
            'product_comment_status' => $request->status,
        ];

        // Update the data
        $db_product_comment->update($data);
    }
}
