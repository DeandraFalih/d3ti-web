<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ClientTagsController extends Controller
{
    public function showTags()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/tags');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/tags/tags', [
            'data_tags' => $data->data_tags,
        ]);
    }

    public function createTagsProcess(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/tags/process',
        [
            'json' => [
                'name' => $request->name,
                'description' => $request->description,
            ]
        ]
        );

        return redirect('/d3ti-admin/tags');
    }

    public function editTagsProcess(Request $request, $tags_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_tags/process/'.$tags_id,
        [
            'json' => [
                'name' => $request->name,
                'description' => $request->description,
            ]
        ]
        );

        return redirect('/d3ti-admin/tags');
    }

    public function deleteTags($tags_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('DELETE', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/delete_tags/'.$tags_id);

        return redirect('/d3ti-admin/tags');
    }
}
