<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Book;

use Illuminate\Http\Request;
use Gate;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;




class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('order_access'), 403);
        $order =Order::all();
        return BaseController::sendResponse(OrderResource::collection($order),
        'Order sent sussesfully');
    }


    public function store(StoreOrderRequest $request)
    {
          abort_if(Gate::denies('order_create'), 403);
        $order = Order::create($request->validated());
        return BaseController::sendResponse(new OrderResource($order), 'Order created successfully');
    }


    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), 403);
        return BaseController::sendResponse(new OrderResource($order
        ->load(['user',"book"])
        ->append('name')
    ), 'In Order');
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        abort_if(Gate::denies('order_update'), 403);
        $order->update($request->validated());
        return BaseController::sendResponse(new OrderResource($order), 'Order updated successfully');
    }


    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), 403);
        $order->delete();
        return BaseController::sendResponse(new OrderResource($order), 'Order deleted successfully');
    }
}
