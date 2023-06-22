<?php

namespace App\Http\Controllers\Admin\api\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FormatroleResource;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function showRole()
    {
        $data_role=DB::table('d3ti_role')->get();

        return [
            'data_role' => $data_role,
        ];
    }

    public function manageRolePermissionsProcess(Request $request, $role_id)
    {
        $permissions = [
            'access_post',
            'write_post',
            'publish_post',
            'delete_post',
            'review_post',
            'access_event',
            'write_event',
            'publish_event',
            'delete_event',
            'review_event',
            'access_product',
            'write_product',
            'publish_product',
            'delete_product',
            'review_product',
            'access_user',
            'add_user',
        ];

        foreach ($permissions as $permission) {
            $permission_value = $request->$permission ? '1' : '0';

        DB::table('d3ti_role_permission')
            ->where('role_id', $role_id)
            ->where('role_permission_name', $permission)
            ->update(['role_permission_is_granted' => $permission_value]);
        }
    }
}
