<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Idea;
use App\Models\Space;
use Franzose\ClosureTable\Models\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavePageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $transactions = collect($request['transactions']);

        // トランザクション毎に処理
        $transactions->map(function ($transaction) use ($userId) {
            $spaceId = $transaction['space_id'];

            // upsertするやつ
            $ideas = [];

            $operations = collect($transaction['operations']);

            foreach ($operations as $operation) {
                $command = $operation['command'];

                $args = $operation['args'];

                // コマンド毎に分岐して処理
                switch ($command) {
                    case 'next':
                        $idea = $this->next($userId, $args[0], $args[1]);

                        $ideas[$args[0]] = $idea;
                        break;
                }
            }


            // TODO 保存処理
            foreach ($ideas as $idea) {
                // アイデアの作成
                $idea->save();

                // スペースにアイデアを紐付ける
                $idea->spaces()->syncWithoutDetaching([$spaceId]);
            }

        });

        return response()->json([
            'code' => 200,
            'data' => $transactions
        ]);
    }

    /***
     * アイデアを作成する処理
     *
     * @param $userId
     * @param $ideaId
     * @param $previousIdea
     * 一つ前のアイデア　
     * @return Idea
     */
    private function next($userId, $ideaId, $previousIdea): Idea
    {
        // args: [追加するid, 一つ前のid]
        $idea = new Idea();

        // 一つ前のアイデアを探してポジションをセット
        // TODO 懸念点、positionがずれたときにやばそう
        if (isset($previousIdea)) {
            $currentIdea = Idea::query()->where('id', '=', $previousIdea)->first();
            $idea['position'] = $currentIdea['position'] + 1;
        }

        $idea['id'] = $ideaId;
        $idea['user_id'] = $userId;
        $idea['title'] = '';
        $idea['status'] = 0;
        $idea['public'] = false;

        return $idea;
    }
}
