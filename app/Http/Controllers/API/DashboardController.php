<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Comment;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('status', '0')->count();
        $category = Category::where('status', '1')->count();
        $orders = Order::count();
        $comments = Comment::count();
        return response()->json([
            'status' => 200,
            'products' => $products,
            'categories' => $category,
            'orders' => $orders,
            'comments' => $comments,
        ]);
    }


}
