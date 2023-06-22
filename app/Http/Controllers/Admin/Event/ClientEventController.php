<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;

class ClientEventController extends Controller
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
     * Event
     * 
     **/

    public function showEvent()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_event');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/event/allevent', [
            'data_event' => $data->data_event,
        ]);
    }

    public function showUserEvent()
    {
        $user = Auth::user();
        $user_name = $user->user_name;

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_event/user_event/'.$user_name);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/event/allevent', [
            'data_event' => $data->data_event,
        ]);
    }

    public function showEventByStatus($status)
    {
        if($status == "draft_event"){
            $status = "Draft";
        }else if($status == "published_event"){
            $status = "Published";
        }else if($status == "pending_event"){
            $status = "Pending";
        }else if($status == "trash_event"){
            $status = "Trash";
        }

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_event/'.$status);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/event/allevent', [
            'data_event' => $data->data_event,
        ]);
    }

    public function createEventForm()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_event');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/event/addevent', [
            'data_tags' => $data->data_tags,
        ]);
    }

    public function createEventProcess(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required',
            'content' => 'required',
            'date_of_event' => 'required',
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
        $count = DB::table('d3ti_event')->where('event_link', $link)->count();

        //Adding "-" + number for the duplicate link to make it unique
        if ($count > 0) {
            $i = 1;
            while (true) {
                $newLink = $link . '-' . $i;
                $count = DB::table('d3ti_event')->where('event_link', $newLink)->count();
                if ($count == 0) {
                    $link = $newLink;
                    break;
                }
                $i++;
            }
        }

        //Replace "../" from content to absolute URL
        $content = $request->content;
        $content = str_replace('../', 'https://d3tisolo.vokasi.uns.ac.id/public/', $content);

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
        
        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_event/process',
        [
            'json' => [
                'title' => $request->title,
                'featured' => $filename,
                'content' => $content,
                'date_of_event' => $request->date_of_event,
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

        return redirect('/d3ti-admin/all_event')->with('status', 'Event has been created.');
    }

    public function editEventForm($event_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_event/'.$event_id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        return view('admin/event/editevent', [
            'data_event' => $data['data_event'],
            'data_tags' => $data['data_tags'],    
        ]);
    }

    public function editEventProcess(Request $request, $event_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'date_of_event' => 'required',
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
        
        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/edit_event/process/'.$event_id,
        [
            'json' => [
                'title' => $request->title,
                'featured' => $filename,
                'content' => $content,
                'date_of_event' => $request->date_of_event,
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

        return redirect('/d3ti-admin/all_event')->with('status', 'Event has been updated.');
    }

     public function previewEvent($event_link)
     {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/event/'.$event_link);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('/admin/preview/previewevent', [
            'data_event' => $data->data_event,
        ]);
     }

    public function deleteEvent($event_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('DELETE', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/delete_event/'.$event_id);

        return redirect('/d3ti-admin/all_event/trash_event')->with('status', 'Event has been deleted.');
    }

    public function trashEvent($event_id)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/trash_event/'.$event_id);

        return redirect('/d3ti-admin/all_event/trash_event')->with('status', 'Event has been moved to trash.');
    }
}
