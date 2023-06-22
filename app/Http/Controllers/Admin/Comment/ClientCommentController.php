<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ClientCommentController extends Controller
{
    public function showPostComment()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/post_comment');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/comment/postcomment', [
            'data_post_comment' => $data->data_post_comment,
        ]);
    }

    public function ApprovePostComment(Request $request, $post_comment_id)
    {
        $status = "Approved";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/post_comment/process/'.$post_comment_id,
        [
            'json' => [
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_comment/post_comment')->with('status', 'Comment has been approved.');
    }

    public function RejectPostComment(Request $request, $post_comment_id)
    {
        $status = "Rejected";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/post_comment/process/'.$post_comment_id,
        [
            'json' => [
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_comment/post_comment')->with('status', 'Comment has been Rejected.');
    }

    public function showEventComment()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/event_comment');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/comment/eventcomment', [
            'data_event_comment' => $data->data_event_comment,
        ]);
    }

    public function ApproveEventComment(Request $request, $event_comment_id)
    {
        $status = "Approved";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/event_comment/process/'.$event_comment_id, [
            'json' => [
                'status' => $status,
            ]
        ]);

        return redirect('/d3ti-admin/all_comment/event_comment')->with('status', 'Comment has been approved.');
    }

    public function RejectEventComment(Request $request, $event_comment_id)
    {
        $status = "Rejected";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/event_comment/process/'.$event_comment_id, [
            'json' => [
                'status' => $status,
            ]
        ]);

        return redirect('/d3ti-admin/all_comment/event_comment')->with('status', 'Comment has been rejected.');
    }

    public function showProductComment()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/product_comment');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/comment/productcomment', [
            'data_product_comment' => $data->data_product_comment,
        ]);
    }

    public function ApproveProductComment(Request $request, $product_comment_id)
    {
        $status = "Approved";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/product_comment/process/'.$product_comment_id, [
            'json' => [
                'status' => $status,
            ]
        ]);

        return redirect('/d3ti-admin/all_comment/product_comment')->with('status', 'Comment has been approved.');
    }

    public function RejectProductComment(Request $request, $product_comment_id)
    {
        $status = "Rejected";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_comment/product_comment/process/'.$product_comment_id, [
            'json' => [
                'status' => $status,
            ]
        ]);

        return redirect('/d3ti-admin/all_comment/product_comment')->with('status', 'Comment has been rejected.');
    }
}
