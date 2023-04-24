<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GrantPermissionRequest;
use App\Http\Requests\RevokePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\BaseController as BaseController;
use Gate;


class PermissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permission_access'), 403);
        $permissions =Permission::all();
        return BaseController::sendResponse(PermissionResource::collection($permissions),'permissions sent sussesfully');
    }



    public function grant(GrantPermissionRequest $request,Role $role)
    {
        abort_if(Gate::denies('permission_grant'), 403);
        $role->LoadMissing('permissions');
        $role->givePermissionTo($request->permissions);
        return BaseController::sendResponse(new RoleResource($role),'permission granted sussesfully');
    }

    public function revoke(RevokePermissionRequest $request ,Role $role)
    {
        abort_if(Gate::denies('permission_revoke'), 403);
        $role->LoadMissing('permissions');
        $role->revokePermissionTo($request->permissions);
        return BaseController::sendResponse(new RoleResource($role),'permission revoked sussesfully');
    }
}
