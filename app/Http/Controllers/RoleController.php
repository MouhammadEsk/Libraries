<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\GrantRoleRequest;
use App\Http\Requests\RevokeRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Resources\RoleResource;;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Book;

use Gate;


class RoleController extends Controller
{
    public function store(StoreRoleRequest $request)
    {
        abort_if(Gate::denies('role_create'), 403);
        $role = Role::create($request->validated()+['guard_name'=>'web']);
        return BaseController::sendResponse(new RoleResource($role),'Role created sussesfully');
    }

    public function index()
    {
        abort_if(Gate::denies('role_access'), 403);
        $roles =Role::all();
        return BaseController::sendResponse($roles,'Roles sent sussesfully');
    }


    public function grant(GrantRoleRequest $request)
    {
       // abort_if(Gate::denies('role_grant'), 403);
        $user = User::with('roles')->where('id','!=',1)->findOrFail($request->user_id);
        $user->assignRole($request->role);
        return BaseController::sendResponse(new UserResource($user),'Role granted sussesfully');
    }

    public function revoke(RevokeRoleRequest $request)
    {
        abort_if(Gate::denies('role_revoke'), 403);
        $user = User::with('roles')->where('id','!=',1)->findOrFail($request->user_id);
        $user->removeRole($request->role);
        return BaseController::sendResponse(new UserResource($user),'Role Revoked sussesfully');
    }


}

