<?php
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MyAPIsKey;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;







/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*oute::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/





//middleware'=>'auth:sanctum
Route::group([''], function () {
    Route::get('/logout',           [AuthController::class, 'logout']);

    // +++++++++++++++++++++++++++++++start Role api+++++++++++++++++++++++++++++++++++
    Route::post('roles/grant',              [RoleController::class     ,  'grant']);
    Route::post('roles/revoke',             [RoleController::class     , 'revoke']);
    Route::post('roles/store',            [RoleController::class       ,'store']);
    Route::get('roles/index',            [RoleController::class       ,'index']);

    // +++++++++++++++++++++++++++++++end Role api+++++++++++++++++++++++++++++++++++++

    // +++++++++++++++++++++++++++++++start Permission api+++++++++++++++++++++++++++++
    Route::post('permissions/grant/{role}', [PermissionController::class,    'grant']);
    Route::post('permissions/revoke/{role}',[PermissionController::class,    'revoke']);
    Route::apiresource('permissions',        PermissionController::class)->except('update','store','destroy','show');
    // +++++++++++++++++++++++++++++++end Permission api+++++++++++++++++++++++++++++++


   // +++++++++++++++++++++++++++++++start Library api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'library'], function() {
        Route::get('/index',               [LibraryController::class,'index']);
        Route::post('/store',              [LibraryController::class,'store']);
        Route::get('/show/{library}',      [LibraryController::class,'show' ]);
        Route::put('/update/{library}',    [LibraryController::class,'update']);
        Route::delete('/destroy/{library}',[LibraryController::class,'destroy']);
        Route::post('/search/{city}',             [LibraryController::class,'search']);
        Route::get('/servay/{city}',[LibraryController::class,'servay']);
        Route::post('/booksinlibrary/{library_id}',             [LibraryController::class,'booksinlibrary']);


 });
 //+++++++++++++++++++++++++++++++end Library api+++++++++++++++++++++++++++++++++++


   // +++++++++++++++++++++++++++++++start Category api+++++++++++++++++++++++++++++++++++
   Route::group(['prefix' => 'category'], function() {
    Route::get('/index',               [CategoryController::class,'index']);
    Route::post('/store',              [CategoryController::class,'store']);
    Route::get('/show/{category}',      [CategoryController::class,'show' ]);
    Route::put('/update/{category}',    [CategoryController::class,'update']);
    Route::delete('/destroy/{category}',[CategoryController::class,'destroy']);
    Route::get('/mycategory/{category}',[CategoryController::class,'mycategory']);

});
//+++++++++++++++++++++++++++++++end Category api+++++++++++++++++++++++++++++++++++


   // +++++++++++++++++++++++++++++++start Book api+++++++++++++++++++++++++++++++++++
   Route::group(['prefix' => 'books'], function() {
    Route::get('/index',               [BookController::class,'index']);
    Route::post('/store',              [BookController::class,'store']);
    Route::get('/show/{book}',      [BookController::class,'show' ]);
    Route::put('/update/{book}',    [BookController::class,'update']);
    Route::delete('/destroy/{book}',[BookController::class,'destroy']);
    Route::post('/search/{name}',             [BookController::class,'search']);


});
//+++++++++++++++++++++++++++++++end Book api+++++++++++++++++++++++++++++++++++

// +++++++++++++++++++++++++++++++start Order api+++++++++++++++++++++++++++++++++++
Route::group(['prefix' => 'orders'], function() {
    Route::get('/index',               [OrderController::class,'index']);
    Route::post('/store',              [OrderController::class,'store']);
    Route::get('/show/{order}',      [OrderController::class,'show' ]);
    Route::put('/update/{order}',    [OrderController::class,'update']);
    Route::delete('/destroy/{order}',[OrderController::class,'destroy']);


});
//+++++++++++++++++++++++++++++++end Book api+++++++++++++++++++++++++++++++++++







});











Route::group(['middleware' => MyAPIsKey::class], function () {
    Route::group(['prefix' => 'User'], function () {
        Route::post('/login',           [AuthController::class, 'login']);
        Route::post('/register',        [AuthController::class, 'register']);
    });
});

