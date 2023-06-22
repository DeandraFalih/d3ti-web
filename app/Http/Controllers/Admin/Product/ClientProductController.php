<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;

class ClientProductController extends Controller
{
    /**
     * 
     * 
     * 
     * CMS
     * 
     * 
     * 
     **/


    /**
     * 
     * Product
     * 
     **/

    public function showProduct()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_product');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/product/allproduct', [
            'data_product' => $data->data_product,
        ]);
    }

    public function showUserProduct()
    {
        $user = Auth::user();
        $user_name = $user->user_name;

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_product/user_product/'.$user_name);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/product/allproduct', [
            'data_product' => $data->data_product,
        ]);
    }

    public function showProductByStatus($status)
    {
        if($status == "draft_product"){
            $status = "Draft";
        }else if($status == "published_product"){
            $status = "Published";
        }else if($status == "pending_product"){
            $status = "Pending";
        }else if($status == "trash_product"){
            $status = "Trash";
        }

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_product/'.$status);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/product/allproduct', [
            'data_product' => $data->data_product,
        ]);
    }

    public function createProductForm()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_product');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/product/addproduct', [
            'data_product_categories' => $data->data_product_categories,
            'data_tags' => $data->data_tags,
        ]);
    }

    public function createProductProcess(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required',
            'content' => 'required',
            'category' => 'required',
            'excerpt' => 'required',
            'release_date' => 'required',
            'owner' => 'required',
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
        $count = DB::table('d3ti_product')->where('product_link', $link)->count();

        //Adding "-" + number for the duplicate link to make it unique
        if ($count > 0) {
            $i = 1;
            while (true) {
                $newLink = $link . '-' . $i;
                $count = DB::table('d3ti_product')->where('product_link', $newLink)->count();
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
        
        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_product/process',
        [
            'json' => [
                'title' => $request->title,
                'featured' => $filename,
                'content' => $content,
                'category' => $request->input('category', []),
                'excerpt' => $request->excerpt,
                'release_date' => $request->release_date,
                'owner' => $request->owner,
                'date' => $request->date,
                'link' => $link,
                'meta' => $request->meta,
                'tags' => $request->input('tags', []),
                'author' => $request->author,
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_product')->with('status', 'Product has been created.');
    }

    public function editProductForm($product_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_product/'.$product_id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        return view('admin/product/editproduct', [
            'data_product' => $data['data_product'],
            'data_category' => $data['data_category'],
            'data_tags' => $data['data_tags'],    
        ]);
    }

    public function editProductProcess(Request $request, $product_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'excerpt' => 'required',
            'release_date' => 'required',
            'owner' => 'required',
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
        $content = str_replace('../storage', 'https://d3tisolo.vokasi.uns.ac.id/public/storage', $content);
        $content = str_replace('../http', 'http', $content);
 
        //Adding class and style to the content image
        $content = str_replace('<img src', '<img class="img-fluid w-100" style="object-fit: cover;" src', $content);

        //Retreive the value even when the user doesnt upload featured image
        $featured = $request->file('featured'); 

        //Adding value to $filename if the user doesnt upload featured image
        if($featured == ""){
            $filename = "";
        }

        //Rename the Featured Image and move it to a specific folder if the user upload image
        else{
        $textfeatured = $featured->getClientOriginalName();
        $newtextfeatured = Str::uuid();
        $extension = $featured->getClientOriginalExtension();
        $folder = 'storage/featured_images';
        $featured->move($folder, $newtextfeatured.".".$extension);
        $filename = $newtextfeatured.".".$extension;
          
        $imagePath = $folder.'/'.$filename;

            $image = Image::make($imagePath);

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
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_product/process/'.$product_id,
        [
            'json' => [
                'title' => $request->title,
                'featured' => $filename,
                'content' => $content,
                'category' => $request->input('category', []),
                'excerpt' => $request->excerpt,
                'release_date' => $request->release_date,
                'owner' => $request->owner,
                'date' => $request->date,
                'link' => $request->link,
                'meta' => $request->meta,
                'tags' => $request->input('tags', []),
                'author' => $request->author,
                'status' => $status,
            ]
        ]
        );

        return redirect('/d3ti-admin/all_product')->with('status', 'Product has been updated.');
    }

     public function previewProduct($product_link)
     {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/news/'.$product_link);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('/admin/preview/previewproduct', [
            'data_product' => $data->data_product,
        ]);
     }

    public function deleteProduct($product_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('DELETE', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/delete_product/'.$product_id);

        return redirect('/d3ti-admin/all_product/trash_product')->with('status', 'Product has been deleted.');
    }

    public function trashProduct($product_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/trash_product/'.$product_id);

        return redirect('/d3ti-admin/all_product/trash_product')->with('status', 'Product has been moved to trash.');
    }

    /**
     * 
     * Product Categories
     * 
     **/

    public function showProductCategories()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/product_categories');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/product/categories', [
            'data_product_categories' => $data->data_product_categories,
        ]);
    }

    public function createProductCategoriesProcess(Request $request)
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
        
        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/product_categories/process',
        [
            'json' => [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $request->url,
            ]
        ]
        );

        return redirect('/d3ti-admin/product_categories')->with('status', 'Category has been created.');
    }


    public function editProductCategoriesProcess(Request $request, $product_categories_id)
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
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_product_categories/process/'.$product_categories_id,
        [
            'json' => [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $url,
            ]
        ]
        );

        return redirect('/d3ti-admin/product_categories')->with('status', 'Category has been updated.');
    }

    public function deleteProductCategories($product_categories_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('DELETE', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/delete_product_categories/'.$product_categories_id);

        return redirect('/d3ti-admin/product_categories')->with('status', 'Category has been deleted.');
    }
    






    /**
     * 
     * 
     * 
     * Frontend Website
     * 
     * 
     * 
     **/







    public function showHomepage()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('user/dashboard/dashboard', [
            'data_product' => $data->data_product,
        ]);
    }

     public function showProductArticle($product_link)
     {
        $client = new Client();
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/product/'.$product_link);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('/user/news/newslayout', [
            'data_post' => $data->data_post,
        ]);
     }
}
