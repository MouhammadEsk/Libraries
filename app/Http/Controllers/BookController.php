<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Gate;
use App\Models\Library;
use App\Http\Controllers\Controller;





class BookController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('books_access'), 403);
        $book =Book::all();
        return BaseController::sendResponse(BookResource::collection($book),
        'Books sent sussesfully');
    }



    public function store(StoreBookRequest $request)
    {
    //  abort_if(Gate::denies('book_create'), 403);

        $file          = $request->file('link');
        $filefirstname = substr($file->getClientOriginalName(),0,-5);
        $extension     = $file->getClientOriginalExtension();
        $filename      = $filefirstname.time().'.'.$extension;

        $file->move('uploads/books/',$filename);



        $book = Book::create([
            'link'=>$filename,
            'name'=>$request->name,
            'info'=>$request->info,
            'auther'=>$request->auther,
            'publishing_house'=>$request->publishing_house,
            'date'=>$request->date,
            'availablity'=>$request->availablity,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
        ]);
        $book->library()->attach($request->library);


        return BaseController::sendResponse(new BookResource($book), 'Book created successfully');
    }

    public function show(Book $book)
    {
        abort_if(Gate::denies('book_show'), 403);
        return BaseController::sendResponse(new BookResource($book), 'In Book');
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        abort_if(Gate::denies('book_update'), 403);
        $book->update($request->validated());
        return BaseController::sendResponse(new BookResource($book), 'Book updated successfully');
    }


    public function destroy(Book $book)
    {

        abort_if(Gate::denies('book_delete'), 403);
        $book->delete();
        return BaseController::sendResponse(new BookResource($book), 'Book deleted successfully');
    }

    public function search(Request $request){
        $book = Book::where('name','like',"{$request->name}")->get();
        return BaseController::sendResponse(BookResource::collection($book),
        'In Book');
    }




}
