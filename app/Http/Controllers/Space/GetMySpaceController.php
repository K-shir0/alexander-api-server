<?php

namespace App\Http\Controllers\Space;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetMySpaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = Auth::user();

        $spaces = Space::query()->where('user_id', '=', $user->id)->get();

        return response()->json([
            'code' => 200,
            'data' => ['spaces' => $spaces],
        ]);
    }
}
