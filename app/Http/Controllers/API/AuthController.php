<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:191',
                'email' => 'required|email|max:191|unique:users,email',
                'password' => 'required|min:8',
            ],
            [
                'required'  => 'Bạn phải điền :attribute',
            ]
        );
        if ($validator->fails()) {
            $errors = $validator->messages();
            if ($errors->has('email')) {
                return response()->json([
                    'status' => 409,
                    'message' => 'Email đã tồn tại.',
                ]);
            }
            return response()->json([
                'validator_errors' => $errors,
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken($user->email . '_Token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'username' => $user->name,
                'token' => $token,
                'message' => 'Đăng ký thành công.',
            ]);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|max:191',
                'password' => 'required',
            ],
            [
                'required'  => 'Bạn phải điền :attribute',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'validator_errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Thông tin không hợp lệ!',
                ]);
            } else {
                if ($user->role_as == 1) { // admin
                    $role = 'admin';
                    $token = $user->createToken($user->email . '_AdminToken', ['server:admin'])->plainTextToken;
                } else {
                    $role = '';
                    $token = $user->createToken($user->email . '_Token', [''])->plainTextToken;
                }
                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'token' => $token,
                    'message' => 'Đăng nhập thành công.',
                    'role' => $role,
                ]);
            }
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Đã đăng xuất.',
        ]);
    }
}
