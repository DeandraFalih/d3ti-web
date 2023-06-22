<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class ClientUserController extends Controller
{
    public function showAllUser()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/all_user/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/user/alluser', [
            'data_user' => $data->data_user,
            'data_role' => $data->data_role,
        ]);
    }

    public function createUserProcess(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('POST', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/add_user/process', [
            'json' => [
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'role' => $request->role,
            ],
        ]);

        return redirect('/d3ti-admin/all_user')->with('status', 'User has been created.');
    }

    public function myProfile()
    {
        $user = Auth::user();
        $user_username = $user->user_username;
        
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/my_profile/'.$user_username);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/user/viewprofile', [
            'data_user' => $data->data_user,
        ]);
    }

    public function viewProfile($user_id)
    {
        $user_username = User::where('user_id', '=', $user_id)
            ->value('user_username');
            
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        
        $response = $client->request('GET', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/my_profile/'.$user_username);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body);

        return view('admin/user/viewprofile', [
            'data_user' => $data->data_user,
        ]);
    }

    public function editProfileProcess(Request $request)
    {
        $user_id = $request->id;

        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'bio' => 'required',
            'role' => 'required',
        ]);

        // Checking Input Profile
        $profile_data_url = $request->input('profile');
        if ($profile_data_url == "") {
            $filename = "";
        } else {
            // Decode the Base64 Image and Rename the Profile Image and Move it to a Specific Folder
            list($type, $data) = explode(';', $profile_data_url);
            list(, $data) = explode(',', $data);
            $profile_image = base64_decode($data);
            $extension = explode('/', explode(':', $type)[1])[1];

            $filename = Str::uuid().'.'.$extension;
            $folder = 'storage/profile';
            $image_path = $folder.'/'.$filename;
            file_put_contents($image_path, $profile_image);
        }

        // Check the Old Password and Send the New Password to Response
        $user = Auth::user();
        $user_password = $user->password;

        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        if ($old_password == "" && $new_password == "") {
            $password = "";
        }else if($old_password == "" && $new_password !== ""){
            $password = bcrypt($new_password);
        }else if($old_password !== "" && $new_password !== ""){
            if (!Hash::check($old_password, $user_password)) {
                return redirect('/d3ti-admin/my_profile')->with('error', 'Old Password Incorrect');
            }

            $password = bcrypt($new_password);
        }

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session('api_token'),
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request('PUT', 'https://d3tisolo.vokasi.uns.ac.id/api/d3ti-admin/my_profile/edit_process/'.$user_id, [
            'json' => [
                'name' => $request->name,
                'username' => $request->username,
                'profile' => $filename,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'bio' => $request->bio,
                'password' => $password,
            ],
        ]);

        return back()->with('status', 'Profile has been updated.');
    }
}
