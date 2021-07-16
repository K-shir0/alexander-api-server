<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetPageController extends Controller
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
        $space_id = $request->id;

        $space = Space::query()
            ->where('id', '=', $space_id)
            ->with('ideas')
            ->firstOrFail();

        return response()->json([
            'code' => 200,
            'data' => ['ideas' => $space->ideas],
        ]);
    }
}
