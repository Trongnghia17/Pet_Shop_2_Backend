<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function placeorder(Request $request)
    {
        if (auth('sanctum')->check()) {
            $rules = [
                'address' => 'required|max:255',
                'payment_mode' => 'required|in:cod,stripe',
                'amount' => 'required|numeric|min:1|max:99999999', // Add max validation
            ];

            if ($request->payment_mode === 'stripe') {
                $rules = array_merge($rules, [
                    'stripeToken' => 'required',
                ]);
            }

            $validator = Validator::make($request->all(), $rules, [
                'required' => 'Bạn phải điền :attribute',
                'in' => 'Hình thức thanh toán không hợp lệ',
                'numeric' => 'Tổng tiền phải là số',
                'min' => 'Tổng tiền phải lớn hơn 0',
                'max' => 'Tổng tiền không được vượt quá 99,999,999 VND', // Add max validation message
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'errors' => $validator->messages(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                if ($request->payment_mode === 'stripe') {
                    try {
                        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                        Stripe\Charge::create([
                            "amount" => $request->amount , // Stripe expects the amount in cents
                            "currency" => "VND",
                            "source" => $request->stripeToken,
                            "description" => "Thanh toán thành công!"
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                            'message' => 'Đã xảy ra lỗi khi thanh toán bằng Stripe: ' . $e->getMessage(),
                        ], Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }

                $user_id = auth('sanctum')->user()->id;
                $order = new Order;
                $order->user_id = $user_id;
                $order->amount = $request->amount;
                $order->address = $request->address;
                $order->payment_mode = $request->payment_mode;
                $order->tracking_no = 'petshop' . rand(1111, 9999);
                $order->save();

                $cart = Cart::where('user_id', $user_id)->where('is_selected', true)->get();
                $orderitems = [];
                foreach ($cart as $item) {
                    $orderitems[] = [
                        'product_id' => $item->product_id,
                        'quantity' => $item->product_quantity,
                        'price' => $item->product->selling_price,
                        'name' => $item->product->name,
                        'image' => $item->product->image,
                    ];
                    $item->product->update([
                        'quantity' => $item->product->quantity - $item->product_quantity
                    ]);
                }
                $order->orderitems()->createMany($orderitems);
                Cart::destroy($cart);

                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Đặt hàng thành công.',
                ]);
            }
        } else {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Đăng nhập để tiếp tục!',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
