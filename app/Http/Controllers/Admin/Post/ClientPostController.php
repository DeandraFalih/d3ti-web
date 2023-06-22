<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\DailyView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class ClientPostController extends Controller
{
    /**
     * 
     * Post
     * 
     **/

    public function showDashboard()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/dashboard/dashboard', [
            'view_data' => $data->view_data,
            'daily_data' => $data->daily_data,
        ]);
    }
  
    public function showPost()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_post');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/post/allpost', [
            'data_post' => $data->data_post,
        ]);
    }

    public function showUserPost()
    {
        $user = Auth::user();
        $user_name = $user->user_name;

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_post/user_post/'.$user_name);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/post/allpost', [
            'data_post' => $data->data_post,
        ]);
    }

    public function showPostByStatus($status)
    {
        if($status == "draft_post"){
            $status = "Draft";
        }else if($status == "published_post"){
            $status = "Published";
        }else if($status == "pending_post"){
            $status = "Pending";
        }else if($status == "trash_post"){
            $status = "Trash";
        }

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_post/'.$status);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/post/allpost', [
            'data_post' => $data->data_post,
        ]);
    }

    public function createPostForm()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_post');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/post/addpost', [
            'data_post_categories' => $data->data_post_categories,
            'data_tags' => $data->data_tags,
        ]);
    }

    public function createPostProcess(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required',
            'content' => 'required',
            'category' => 'required',
            'excerpt' => 'required',
            'date' => 'required',
            'link' => 'required',
            'meta' => 'required',
            'tags' => 'required',
            'author' => 'required',
            'submit' => 'required',
        ]);
        
        //Replace the status value from "Publish" to "Published"
        $status = $request->submit;
        if ($status == "Publish"){
            $status = "Published";
        }

        //Check if there is duplicate link on the database
        $link = $request->link; 
        $count = DB::table('d3ti_post')->where('post_link', $link)->count();

        //Adding "-" + number for the duplicate link to make it unique
        if ($count > 0) {
            $i = 1;
            while (true) {
                $newLink = $link . '-' . $i;
                $count = DB::table('d3ti_post')->where('post_link', $newLink)->count();
                if ($count == 0) {
                    $link = $newLink;
                    break;
                }
                $i++;
            }
        }

        //Replace "../" from content to absolute URL
        $content = $request->content;
        $content = str_replace('../', 'https://d3tisolo.vokasi.uns.ac.id/', $content);

        //Adding class and style to the content image
        $content = str_replace('<img src', '<img class="img-fluid w-100" style="object-fit: cover;" src', $content);

        //Decode the Base64 Image and Rename the Featured Image and move it to a specific folder
        $featuredDataURL = $request->input('featured');
        list($type, $data) = explode(';', $featuredDataURL);
        list(, $data) = explode(',', $data);
        $featuredImage = base64_decode($data);
        $extension = explode('/', explode(':', $type)[1])[1];

        $filename = Str::uuid().'.'.$extension;
        $folder = 'storage/featured_images';
        $imagePath = $folder.'/'.$filename;
        file_put_contents($imagePath, $featuredImage);
        
        //Create a new image instance from the original image
        $image = Image::make($imagePath);

        //Resize the image to 302x200 and save it with the new filename
        $newFilename = '(thumbnail)' . pathinfo($filename, PATHINFO_FILENAME) . '.' . $extension;
        $newImagePath = $folder . '/' . $newFilename;
        $image->fit(302, 170)->save($newImagePath);

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_post/process',
        [
            'json' => [
                'title' => $request->title,
                'featured' => $filename,
                'content' => $content,
                'category' => $request->input('category', []),
                'excerpt' => $request->excerpt,
                'date' => $request->date,
                'link' => $link,
                'meta' => $request->meta,
                'tags' => $request->input('tags', []),
                'author' => $request->author,
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_post')->with('status', 'Post has been created.');
    }

    public function editPostForm($post_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_post/'.$post_id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        return view('admin/post/editpost', [
            'data_post' => $data['data_post'],
            'data_category' => $data['data_category'],
            'data_tags' => $data['data_tags'],    
        ]);
    }

    public function editPostProcess(Request $request, $post_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'excerpt' => 'required',
            'date' => 'required',
            'link' => 'required',
            'meta' => 'required',
            'tags' => 'required',
            'author' => 'required',
            'submit' => 'required',
        ]);

        //Replace the status value from "Publish" to "Published"
        $status = $request->submit;
        if ($status == "Publish" || $status == "Update"){
            $status = "Published";
        }

        //Replace "../" from content to absolute URL
        $content = $request->content;
        $content = str_replace('../storage', 'https://d3tisolo.vokasi.uns.ac.id/storage', $content);
        $content = str_replace('../http', 'http', $content);
 
        //Adding class and style to the content image
        $content = str_replace('<img src', '<img class="img-fluid w-100" style="object-fit: cover;" src', $content);

        //Retreive the value even when the user doesnt upload featured image
        $featuredDataURL = $request->input('featured');

        //Adding value to $filename if the user doesnt upload featured image
        if($featuredDataURL == ""){
            $filename = "";
        }

        //Rename the Featured Image and move it to a specific folder if the user upload image
        else{
            //Decode the Base64 Image and Rename the Featured Image and move it to a specific folder
            list($type, $data) = explode(';', $featuredDataURL);
            list(, $data) = explode(',', $data);
            $featuredImage = base64_decode($data);
            $extension = explode('/', explode(':', $type)[1])[1];

            $filename = Str::uuid().'.'.$extension;
            $folder = 'storage/featured_images';
            $imagePath = $folder.'/'.$filename;
            file_put_contents($imagePath, $featuredImage);

            //Create a new image instance from the original image
            $image = Image::make($imagePath);

            //Resize the image to 302x200 and save it with the new filename
            $newFilename = '(thumbnail)' . pathinfo($filename, PATHINFO_FILENAME) . '.' . $extension;
            $newImagePath = $folder . '/' . $newFilename;
            $image->fit(302, 170)->save($newImagePath);
        }
        
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_post/process/'.$post_id,
        [
            'json' => [
                'title' => $request->title,
                'featured' => $filename,
                'content' => $content,
                'category' => $request->input('category', []),
                'excerpt' => $request->excerpt,
                'date' => $request->date,
                'link' => $request->link,
                'meta' => $request->meta,
                'tags' => $request->input('tags', []),
                'author' => $request->author,
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_post')->with('status', 'Post has been updated.');
    }

     public function previewPost($post_link)
     {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/preview_post/'.$post_link);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('/admin/preview/previewpost', [
            'data_post' => $data->data_post,
        ]);
     }

    public function publishPostProcess(Request $request, $post_id)
    {
        $status = "Published";
        
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/publish_post/process/'.$post_id,
        [
            'json' => [
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_post')->with('status', 'Post has been published.');
    }

    public function deletePost($post_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('DELETE', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/delete_post/'.$post_id);

        return redirect('/d3ti-admin/all_post/trash_post')->with('status', 'Post has been deleted.');
    }

    public function trashPost($post_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/trash_post/'.$post_id);

        return redirect('/d3ti-admin/all_post/trash_post')->with('status', 'Post has been moved to trash.');
    }

    /**
     * 
     * Post Categories
     * 
     **/

    public function showCategories()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/post_categories');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/post/categories', [
            'data_post_categories' => $data->data_post_categories,
        ]);
    }

    public function createCategoriesProcess(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/post_categories/process',
        [
            'json' => [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $request->url,
            ]
        ]
        );

        return redirect('/d3ti-admin/post_categories')->with('status', 'Category has been created.');
    }


    public function editCategoriesProcess(Request $request, $post_categories_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);

        $url = $request->url;
        $url = str_replace(' ', '-', strtolower($url));

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/d3ti-admin/edit_categories/process/'.$post_categories_id,
        [
            'json' => [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $url,
            ]
        ]
        );

        return redirect('/d3ti-admin/post_categories')->with('status', 'Category has been updated.');
    }

    public function deleteCategories($post_categories_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('DELETE', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/delete_categories/'.$post_categories_id);

        return redirect('/d3ti-admin/post_categories')->with('status', 'Category has been deleted.');
    }
}
