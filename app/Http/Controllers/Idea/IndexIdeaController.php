<?php

namespace App\Http\Controllers\Idea;

use App\Http\Controllers\Controller;
use App\Idea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexIdeaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $ideas = Idea::query()->get();

        return response()->json([
            'code' => 200,
            'data' => ['ideas' => $ideas],
        ]);
    }
}
