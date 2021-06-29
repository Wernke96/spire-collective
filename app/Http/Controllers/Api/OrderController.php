<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SpireCollective\Domain\Services\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private OrderServices $orderServices;

    public function __construct(OrderServices $orderServices)
    {
        $this->orderServices = $orderServices;
    }

    public function sendOrder(Request $request)
    {
        $orderId = $request->input("bigcommerce_order_id");
        $this->orderServices->sendOrder($orderId);
        return response()->json(["message" => "success"],Response::HTTP_CREATED);

    }
}
