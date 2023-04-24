<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\User;
use App\Models\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Http\Resources\LibraryResource;
use App\Http\Resources\BookResource;

use Illuminate\Support\Facades\DB;

use Gate;





class LibraryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('library_access'), 403);
        $library =Library::all();
        return BaseController::sendResponse(LibraryResource::collection($library),
        'Libraries sent sussesfully');
    }


    public function store(StoreLibraryRequest $request)
    {
      //  abort_if(Gate::denies('library_create'), 403);
        $library = Library::create($request->validated());
        // $book=Book::first();
        $library->books()->attach($request->book);

        return BaseController::sendResponse(new LibraryResource($library), 'Library created successfully');
    }



    public function show(Library $library)
    {
        abort_if(Gate::denies('library_show'), 403);
        return BaseController::sendResponse(new LibraryResource($library), 'In Library');
    }


    public function update(UpdateLibraryRequest $request, Library $library)
    {
        abort_if(Gate::denies('library_update'), 403);
        $library->update($request->validated());
        return BaseController::sendResponse(new LibraryResource($library), 'Library updated successfully');
    }


    public function destroy(Library $library)
    {
        abort_if(Gate::denies('library_delete'), 403);
        $library->delete();
        return BaseController::sendResponse(new LibraryResource($library), 'Library deleted successfully');
    }

    public function servay(Library $library,Request $request)
    {

        $library = Library::where('city','like',"{$request->city}")->get();
        $libcount=$library->count();


        //get all books with count oreders by library id
        return BaseController::sendResponse($libcount,
        'Number of Libraries in city');
    }
    public function search(Request $request){
        $library = Library::where('city','like',"{$request->city}")->get();
        return BaseController::sendResponse(LibraryResource::collection($library),
        'In Library');

    }

    public function booksinlibrary(Request $request ,Library $library){

       $library= DB::table('book_library')->where('library_id',$request->library_id)->get();


        return BaseController::sendResponse(LibraryResource::collection($library),
        'Books In Library');
     }


}
