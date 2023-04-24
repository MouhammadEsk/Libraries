<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController ;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Contracts\Role as ContractsRole;
use App\Http\Resources\UserResource;


class AuthController extends Controller
{


    public function register(RegisterRequest $request)
    {
        $input=$request->validated();
        $input['password']=Hash::make($input['password']);

        $user=User::create($input);
        $user->assignRole($request->role);
        $token['token']=$user->createtoken('yaya yoyo yeye')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        return BaseController::sendResponse($response,'user registed successfully Please Wait Untile The Admin Approve Your Request ');
    }

    public function login(LoginRequest $request){

        $user=User::where('email',$request->email )->first();
        if (!$user) {
            return BaseController::sendError('no such email');
        }

        if (!Hash::check($request->password ,$user->password)) {
            return BaseController::sendError('Incorrect password');
        }

        $token['token']=$user->createtoken('yaya yoyo yeye')->plainTextToken;



        $response=[
            'user'=>$user,
            'token'=>$token,
            'role'=>$user->roles
        ];
        return BaseController::sendResponse($response,'you logged in');
    }

    /**
     * [logout description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(){

        auth()->user()->tokens()->delete();
        return ['message'=>' you logged out'];
    }
}
