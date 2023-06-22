<?php

namespace App\Http\Controllers\Admin\api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\FormatPostResource;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showAllUser()
    {
        $data_user = User::all();
        $data_role = Role::all();

        return [
            'data_user' => $data_user,
            'data_role' => $data_role,
        ];
    }

    public function createUserProcess(Request $request)
    {
        $user = User::create([
            'user_name' => $request->name,
            'user_username' => $request->username,
            'user_email' => $request->email,
            'password' => $request->password,
            'user_role' => $request->role,
            'user_bio' => "-",
            'user_phone' => "0",
        ]);
    }

    public function myProfile($user_username)
    {
        $data_user = User::where('user_username', $user_username)
        ->get();
        $data_role = Role::all();

        return [
            'data_user' => $data_user,
        ];
    }

    public function editProfileProcess(Request $request, $user_id)
    {
        $db_user = User::findOrFail($user_id);

        $profile = $request->profile;
        $password = $request->password;

        $data = [
            'user_name' => $request->name,
            'user_username' => $request->username,
            'user_email' => $request->email,
            'user_bio' => $request->bio,
            'user_role' => $request->role,
            'user_phone' => $request->phone,
        ];

        //Check if there is value in the $profile and $password. And if there is, it will update the profile and password
        if ($profile != "") {
            $data['user_picture'] = $profile;
        }

        if ($password != "") {
            $data['password'] = $password;
        }

        //Update the data
        $db_user->update($data);
    }
}
