<?php

namespace App\Http\Controllers\Admin\api\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategories;
use App\Models\PostCategoriesLink;
use App\Models\Tags;
use App\Models\PostTagsLink;
use App\Models\DailyView;
use App\Http\Resources\FormatPostResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostController extends Controller
{  
    /**
     * 
     * Post
     * 
     **/

    public function showDashboard()
    {
        $date = Carbon::now('GMT+7')->toDateString();

        $daily_data = DailyView::orderBy('daily_view_count', 'desc')
            ->limit(6)
            ->whereDate('created_at', $date)
            ->get();

        $daily_view = DailyView::select('created_at')
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->limit(14)
            ->get()
            ->reverse();

        $view_data = [];

        foreach ($daily_view as $dailyView) {
            $total_view_count = DailyView::where('created_at', $dailyView->created_at)->sum('daily_view_count');
            $date = Carbon::parse($dailyView->created_at)->format('d F Y');
            $view_data[] = [$date, $total_view_count];
        }

        return [
            'view_data' => $view_data,
            'daily_data' => $daily_data,
        ];
    }
  
    public function showPost()
    {
        $data_post = Post::
        where('post_status', '!=', 'trash')
        ->get();

        return [
            'data_post' => $data_post,
        ];
    }

    public function showUserPost($user_name)
    {
        $data_post = Post::
        where('post_author', $user_name)
        ->where('post_status', '!=', 'trash')
        ->get();

        return [
            'data_post' => $data_post,
        ];
    }

    public function showPostByStatus($status)
    {
        $data_post = Post::
        where('post_status', $status)
        ->get();

        return [
            'data_post' => $data_post,
        ];
    }

    public function createPostForm()
    {
        $data_post_categories=PostCategories::all();
        $data_tags=Tags::all();

        return [
            'data_post_categories' => $data_post_categories,
            'data_tags' => $data_tags,
        ];
    }

    public function createPostProcess(Request $request)
    {
        $post = Post::create([
            'post_title' => $request->title,
            'post_featured_image' => $request->featured,
            'post_content' => $request->content,
            'post_excerpt' => $request->excerpt,
            'post_date' => $request->date,
            'post_author' => $request->author,
            'post_link' => $request->link,
            'post_meta' => $request->meta,
            'post_status' => $request->status,
        ]);

        $postId = $post->post_id;
        $categoryIds = $request->category;
        $tagsIds = $request->tags;

        //Create a new category record to database
        foreach ($categoryIds as $categoryId) {
            $link = new PostCategoriesLink();
            $link->post_id = $postId;
            $link->post_categories_id = $categoryId;
            $link->save();
        }

        //Create a new tag record to database
        foreach ($tagsIds as $tagsId) {
            $link = new PostTagsLink();
            $link->post_id = $postId;
            $link->tags_id = $tagsId;
            $link->save();
        }
    }

    public function editPostForm($post_id)
    {
        $data_post = Post::where('post_id', '=', $post_id)->get();
        $data_category = PostCategories::all();
        $data_tags = Tags::all();

        return [
            'data_post' => $data_post,
            'data_category' => $data_category,
            'data_tags' => $data_tags,
        ];
    }

    public function editPostProcess(Request $request, $post_id)
    {
        $db_post = Post::findOrFail($post_id);

        $featured = $request->featured;

        $data = [
            'post_title' => $request->title,
            'post_content' => $request->content,
            'post_excerpt' => $request->excerpt,
            'post_date' => $request->date,
            'post_meta' => $request->meta,
            'post_status' => $request->status,
        ];

        //Check if there is value in the $featured. And if there is, it will update the featured image
        if ($featured != "") {
            $data['post_featured_image'] = $featured;
        }

        //Update the data
        $db_post->update($data);

        $categoryIds = $request->category;
        $tagsIds = $request->tags;

        //Remove current categories record on the database
        PostCategoriesLink::where('post_id', $post_id)->delete();

        //Create a new category record to database
        foreach ($categoryIds as $categoryId) {
            $link = new PostCategoriesLink();
            $link->post_id = $post_id;
            $link->post_categories_id = $categoryId;
            $link->save();
        }

        //Remove current tags record on the database
        PostTagsLink::where('post_id', $post_id)->delete();

        //Create a new tag record to database
        foreach ($tagsIds as $tagsId) {
            $link = new PostTagsLink();
            $link->post_id = $post_id;
            $link->tags_id = $tagsId;
            $link->save();
        }
    }

    public function previewPost($post_link)
    {
        $data_post=Post::where('post_link', '=', $post_link)
        ->get();
        
        return [
            'data_post' => $data_post,
        ];
    }

    public function publishPostProcess(Request $request, $post_id)
    {
        $db_post = Post::findOrFail($post_id);
        
        $data = [
            'post_status' => $request->status,
        ];

        //Update the data
        $db_post->update($data);
    }

    public function deletePost($post_id)
    {
        $data_post = Post::findOrFail($post_id);
        $data_post->delete();
    }

    public function trashPost($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->update([
            'post_status' => 'Trash',
        ]);
    }

    /**
     * 
     * Post Categories
     * 
     **/

    public function showCategories()
    {
        $data_post_categories=PostCategories::all();

        return [
            'data_post_categories' => $data_post_categories,
        ];

    }

    public function createCategoriesProcess(Request $request)
    {
        $receive = PostCategories::create([
            'post_categories_name' => $request->name,
            'post_categories_description' => $request->description,
            'post_categories_url' => $request->url,
        ]);
    }

    public function editCategoriesProcess(Request $request, $post_categories_id)
    {
        $data_post_categories = PostCategories::findOrFail($post_categories_id);
      
        $data_post_categories->update([
            'post_categories_name' => $request->name,
            'post_categories_description' => $request->description,
            'post_categories_url' => $request->url,
        ]);
    }

    public function deleteCategories($post_categories_id)
    {
        $data_categories = PostCategories::findOrFail($post_categories_id);
        $data_categories->delete();
    }
}
