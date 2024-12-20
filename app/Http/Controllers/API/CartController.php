<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (auth('sanctum')->check()) {
            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $product_quantity = $request->product_quantity;
            $productCheck = Product::where('id', $product_id)->first();
            if ($productCheck) {
                if (Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
                    return response()->json([
                        'status' => 409,
                        'message' => $productCheck->name . ' đã được thêm vào giỏ hàng!',
                    ]);
                } else {
                    $cartItem = new Cart;
                    $cartItem->user_id = $user_id;
                    $cartItem->product_id = $product_id;
                    $cartItem->product_quantity = $product_quantity;
                    $cartItem->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Đã thêm vào giỏ hàng.',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tìm thấy thú cưng này!',
                ]);

            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn cần đăng nhập để thêm',
            ]);
        }

    }

    public function viewCart()
    {
        if (auth('sanctum')->check()) {
            $user_id = auth('sanctum')->user()->id;
            $cartItems = Cart::where('user_id', $user_id)->get();
            return response()->json([
                'status' => 200,
                'cart' => $cartItems,
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn cần đăng nhập để xem giỏ hàng!',
            ]);
        }
    }

    public function updateQuantity(Request $request, $cart_id)
    {
        if (auth('sanctum')->check()) {
            $user_id = auth('sanctum')->user()->id;
            $cartItem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();
            if ($cartItem) {
                $quantity = $request->quantity;
                $is_selected = $request->is_selected;
                if (is_numeric($quantity )) {
                    $cartItem->product_quantity = $quantity;
                    if (isset($is_selected)) {
                        $cartItem->is_selected = $is_selected;
                    }
                    $cartItem->update();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Đã cập nhật số lượng.',
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Giá trị không hợp lệ!',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tìm thấy sản phẩm này trong giỏ hàng!',
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Đăng nhập để tiếp tục!',
            ]);
        }
    }

    public function deleteCartItem($cart_id)
    {
        if (auth('sanctum')->check()) {
            $user_id = auth('sanctum')->user()->id;
            $cartItem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();
            if ($cartItem) {
                $cartItem->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công!',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tìm thấy sản phẩm này trong giỏ hàng!',
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng!',
            ]);
        }
    }

}
