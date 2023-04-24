<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Gate;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('categories_access'), 403);
        $category =Category::all();
        return BaseController::sendResponse(CategoryResource::collection($category),
        'Categories sent sussesfully');
    }



    public function store(StoreCategoryRequest $request)
    {
       // abort_if(Gate::denies('category_create'), 403);
        $category = Category::create($request->validated());
        return BaseController::sendResponse(new CategoryResource($category), 'Category created successfully');
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('category_show'), 403);
        return BaseController::sendResponse( new CategoryResource($category), 'In Category');
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        abort_if(Gate::denies('category_update'), 403);
        $category->update($request->validated());
        return BaseController::sendResponse(new CategoryResource($category), 'Category updated successfully');
    }


    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), 403);
        $category->delete();
        return BaseController::sendResponse(new CategoryResource($category), 'Category deleted successfully');
    }

    public function mycategory(Category $category,Request $request){

        $category = Category::where('id','like',"{$request->id}")->get();
        return BaseController::sendResponse(CategoryResource::collection($category
         ->load("book")),
        'Categories with books');
    }
}
