<?php

namespace App\Http\Controllers\Space;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SetSpaceController extends Controller
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

        $space = new Space();

        $space->user_id = $user->id;
        $space->id = $request->id;

        $space->save();

        return response()->json([
            'code' => 200,
        ]);
    }
}
