<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ClientRoleController extends Controller
{
    public function showRole()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
       
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/role');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/role/role', [
            'data_role' => $data->data_role,
        ]);
    }

    public function manageRolePermissionsProcess(Request $request, $role_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
       
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/manage_role_permissions/process/'.$role_id,
        [
            'json' => [
                'access_post' => $request->input('access_post') ? '1' : '0',
                'write_post' => $request->input('post-child-write') ? '1' : '0',
                'publish_post' => $request->input('post-child-post') ? '1' : '0',
                'delete_post' => $request->input('post-child-delete') ? '1' : '0',
                'review_post' => $request->input('post-child-review') ? '1' : '0',
                'access_event' => $request->input('access_event') ? '1' : '0',
                'write_event' => $request->input('event-child-write') ? '1' : '0',
                'publish_event' => $request->input('event-child-publish') ? '1' : '0',
                'delete_event' => $request->input('event-child-delete') ? '1' : '0',
                'review_event' => $request->input('event-child-review') ? '1' : '0',
                'access_product' => $request->input('access_product') ? '1' : '0',
                'write_product' => $request->input('product-child-write') ? '1' : '0',
                'publish_product' => $request->input('product-child-publish') ? '1' : '0',
                'delete_product' => $request->input('product-child-delete') ? '1' : '0',
                'review_product' => $request->input('product-child-review') ? '1' : '0',
                'access_user' => $request->input('access_user') ? '1' : '0',
                'add_user' => $request->input('user-child-add') ? '1' : '0',
            ]
        ]
        );

        return redirect('/d3ti-admin/role');
    }
}
