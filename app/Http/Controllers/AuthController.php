<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * ログイン
     * @param Request $request
     * @return JsonResponse
     */
    public function signIn(Request $request): JsonResponse
    {
        // ログインするための情報
        $credential = $request->only(['email', 'password']);

        $code = 401;
        $data = null;

        // 認証実行
        if (Auth::attempt($credential)) {
            // 認証成功
            $code = 200;
            $data = ['user' => Auth::user()];
        }

        return response()->json([
            'code' => $code,
            'data' => $data
        ], $code);
    }

    /**
     * ログアウト
     * @return JsonResponse
     */
    public function signOut(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'code' => 200,
        ]);
    }
}
