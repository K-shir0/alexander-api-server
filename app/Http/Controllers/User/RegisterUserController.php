<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function __invoke(Request $request): JsonResponse
    {
        // バリデーション
        $validated_request = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User();
        $status = 200;
        $display_name = $request->last_name.$request->first_name;
        $user->display_name = $display_name;

        // fillでUserクラスのfillableの部分に追加しDBに保存
        if (!$user->fill($validated_request)
        ->fill($request->all())->save()) {
            $status = 400;
            $message = 'Bad Request';
        }



        // fillでUserクラスのfillableの部分に追加しDBに保存
        if (!$user->fill($validated_request)
        ->fill($request->all())->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        return response()->json([
            'status' => $status,
        ]);
    }
}
