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
        $user = new User();

        // fillでUserクラスのfillableの部分に追加しDBに保存
        $user->fill($request->all())->save();

        return response()->json([
            'status' => 200,
        ]);
    }
}
