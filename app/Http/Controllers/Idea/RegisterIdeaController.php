<?php

namespace App\Http\Controllers\Idea;

use App\Http\Controllers\Controller;
use App\Idea;
use Franzose\ClosureTable\Models\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterIdeaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $idea = new Idea();

        // fillでIdeaクラスのfillableの部分に追加しDBに保存
        $idea->fill($request->all())->save();

        return response()->json([
            'code' => 200,
        ]);
    }
}
