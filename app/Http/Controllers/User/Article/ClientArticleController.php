<?php

namespace App\Http\Controllers\User\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\PostCategories;
use App\Models\PostComment;
use App\Models\Event;
use App\Models\EventComment;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductComment;
use App\Models\Youtube;
use App\Models\Option;
use App\Models\User;
use App\Models\DailyView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientArticleController extends Controller
{
    public function showPostHomepage()
    {
        $data_post=Post::limit(6)
        ->orderBy('post_date', 'desc')
        ->where('post_status', '=', "Published")
        ->get();
      
        $data_post_reordered = $data_post->skip(3)->concat($data_post->take(3));

        $data_event = Event::limit(6)
            ->orderBy('event_date_of_event', 'desc')
            ->where('event_status', '=', "Published")
            ->get();

        $data_event_reordered = $data_event->skip(3)->concat($data_event->take(3));
      
        $data_youtube=Youtube::limit(6)
        ->orderBy('youtube_id', 'desc')
        ->where('youtube_show', '1')
        ->get();
      
        $data_youtube_reordered = $data_youtube->skip(3)->concat($data_youtube->take(3));
      
        $data_options=Option::all();

        return view('user/dashboard/dashboard', [
            'data_post' => $data_post_reordered,
          	'data_event' => $data_event_reordered,
            'data_youtube' => $data_youtube_reordered,
            'data_options' => $data_options,
        ]);
    }

    public function showPostArticle($post_url, $post_link)
    {
        $data_post=Post::where('post_link', '=', $post_link)
        ->get();

        $recent_post=Post::limit(4)
        ->orderBy('post_date', 'desc')
        ->where('post_status', '=', "Published")
        ->get();

        $post = $data_post->first();
        $date = Carbon::now('GMT+7')->toDateString();

        $post->increment('post_view');

        $daily_view = DailyView::whereDate('created_at', $date)
            ->where('daily_view_title', $post->post_title)
            ->first();

        if ($daily_view) {
            $daily_view->increment('daily_view_count');
        } else {
            DailyView::create([
                'daily_view_title' => $post->post_title,
                'daily_view_count' => 1,
                'daily_view_type' => 'Post',
                'created_at' => $date,
            ]);
        }

        return view('/user/article/postlayout', [
            'data_post' => $data_post,
            'recent_post' => $recent_post,
        ]);
    }

    public function showPostCategory($post_category)
    {
        $category = PostCategories::where('post_categories_url', $post_category)->first();
        $category_name = $category->post_categories_name;

        $paginate_post = Post::join('d3ti_post_categories_link', 'd3ti_post.post_id', '=', 'd3ti_post_categories_link.post_id')
        ->join('d3ti_post_categories', 'd3ti_post_categories_link.post_categories_id', '=', 'd3ti_post_categories.post_categories_id')
        ->where('d3ti_post_categories.post_categories_name', '=', $category_name)
        ->where('d3ti_post.post_status', '=', 'Published')
        ->orderBy('d3ti_post.post_date', 'desc')
        ->paginate(5);

        $recent_post = Post::limit(5)
        ->orderBy('post_date', 'desc')
        ->where('post_status', '=', "Published")
        ->get();

        return view('/user/list/allpostcategory', [
            'category_name' => $category_name,
            'data_post' => $paginate_post,
            'recent_post' => $recent_post,
        ]);
    }

    public function createPostCommentProcess(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',
            'name' => 'required',
            'comment' => 'required',
            'email' => 'required',
        ]);

        $date = Carbon::now('GMT+7')->toDateTimeString();

        $post = PostComment::create([
            'post_id' => $request->post_id,
            'post_comment_name' => $request->name,
            'post_comment_email' => $request->email,
            'post_comment_value' => $request->comment,
			'post_comment_ip' => $request->ip(),
            'post_comment_status' => "Pending",
            'created_at' => $date,
        ]);

        return back()->with('status', 'Thank you for your comment! It will be published after it has been reviewed.');
    }

    public function showProductArticle($product_url, $product_link)
    {
        $data_product=Product::where('product_link', '=', $product_link)
        ->get();

        $product = $data_product->first();
        $date = Carbon::now('GMT+7')->toDateString();

        $product->increment('product_view');
      
      
        $daily_view = DailyView::whereDate('created_at', $date)
            ->where('daily_view_title', $product->product_title)
            ->first();

        if ($daily_view) {
            $daily_view->increment('daily_view_count');
        } else {
            DailyView::create([
                'daily_view_title' => $product->product_title,
                'daily_view_count' => 1,
                'daily_view_type' => 'Product',
                'created_at' => $date,
            ]);
        }

        return view('/user/article/productlayout', [
            'data_product' => $data_product,
        ]);
    }

    public function showProductCategory($product_category)
    {
        $category = ProductCategories::where('product_categories_url', $product_category)->first();
        $category_name = $category->product_categories_name;

        $paginate_product = Product::join('d3ti_product_categories_link', 'd3ti_product.product_id', '=', 'd3ti_product_categories_link.product_id')
        ->join('d3ti_product_categories', 'd3ti_product_categories_link.product_categories_id', '=', 'd3ti_product_categories.product_categories_id')
        ->where('d3ti_product_categories.product_categories_name', '=', $category_name)
        ->where('d3ti_product.product_status', '=', 'Published')
        ->orderBy('d3ti_product.product_date', 'desc')
        ->paginate(5);

        $recent_products = Product::limit(5)
        ->orderBy('product_date', 'desc')
        ->where('product_status', '=', "Published")
        ->get();

        return view('/user/list/allproductcategory', [
            'category_name' => $category_name,
            'data_product' => $paginate_product,
        ]);
    }

    public function createProductCommentProcess(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'name' => 'required',
            'comment' => 'required',
            'email' => 'required',
        ]);

        $date = Carbon::now('GMT+7')->toDateTimeString();

        $product = ProductComment::create([
            'product_id' => $request->product_id,
            'product_comment_name' => $request->name,
            'product_comment_email' => $request->email,
            'product_comment_value' => $request->comment,
			'product_comment_ip' => $request->ip(),
            'product_comment_status' => "Pending",
            'created_at' => $date,
        ]);

        return back()->with('status', 'Thank you for your comment! It will be published after it has been reviewed.');
    }

    public function showEventArticle($event_link)
    {
        $data_event=Event::where('event_link', '=', $event_link)
        ->get();

        $event = $data_event->first();
        $date = Carbon::now('GMT+7')->toDateString();

        $event->increment('event_view');
      
      	$daily_view = DailyView::whereDate('created_at', $date)
        ->where('daily_view_title', $event->event_title)
        ->first();

        if ($daily_view) {
            $daily_view->increment('daily_view_count');
        } else {
            DailyView::create([
                'daily_view_title' => $event->event_title,
                'daily_view_count' => 1,
                'daily_view_type' => 'Event',
                'created_at' => $date,
            ]);
        }

        return view('/user/article/eventlayout', [
            'data_event' => $data_event,
        ]);
    }

    public function showAllEvent()
    {
        $paginate_event = Event::where('d3ti_event.event_status', '=', 'Published')
            ->orderBy('d3ti_event.event_date', 'desc')
            ->paginate(5);


        return view('/user/list/alleventlist', [
            'data_event' => $paginate_event,
        ]);
    }

    public function createEventCommentProcess(Request $request)
    {
        $this->validate($request, [
            'event_id' => 'required',
            'name' => 'required',
            'comment' => 'required',
            'email' => 'required',
        ]);

        $date = Carbon::now('GMT+7')->toDateTimeString();

        $eventComment = EventComment::create([
            'event_id' => $request->event_id,
            'event_comment_name' => $request->name,
            'event_comment_email' => $request->email,
            'event_comment_value' => $request->comment,
			'event_comment_ip' => $request->ip(),
            'event_comment_status' => "Pending",
            'created_at' => $date,
        ]);

        return back()->with('status', 'Thank you for your comment! It will be published after it has been reviewed.');
    }

    public function showListDosen()
    {
      	$data_kaprodi = User::where('user_role', 3)
            ->get();
      
      	$data_kepala = User::where('user_role', 5)
            ->get();
      
        $data_divisi = User::where('user_role', 4)
            ->get();
      
      	$data_dosen = User::where('user_role', 6)
            ->get();

        return view('/user/profil/dosen', [
          	'data_kaprodi' => $data_kaprodi,
          	'data_kepala' => $data_kepala,
          	'data_divisi' => $data_divisi,
            'data_dosen' => $data_dosen,
        ]);
    }

    public function searchArticle(Request $request)
    {
        $search = $request->q;

        $recent_post=Post::limit(4)
        ->orderBy('post_date', 'desc')
        ->where('post_status', '=', "Published")
        ->get();

        $data_post = Post::where('post_status', 'Published')
        ->where(function ($query) use ($search) {
            $query->where('post_title', 'like', '%' . $search . '%')
                ->orWhere('post_content', 'like', '%' . $search . '%');
        })
        ->orderBy('post_date')
        ->paginate(5);

        return view('user/list/search', [
            'data_post' => $data_post,
            'search' => $search,
            'recent_post' => $recent_post
        ]);
    }
}
