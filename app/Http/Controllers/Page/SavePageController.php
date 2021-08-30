<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Idea;
use App\Models\Space;
use Franzose\ClosureTable\Models\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\add;

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

        // upsertするやつ
        $ideas = [];

        // トランザクション毎に処理
        foreach ($transactions as $transaction) {
            $spaceId = $transaction['space_id'];

            $operations = collect($transaction['operations']);

            foreach ($operations as $operation) {
                $command = $operation['command'];

                $args = $operation['args'];

                // コマンド毎に分岐して処理
                switch ($command) {
                    case 'next':
                        // arg0: newIdeaId, arg1: currentSpaceId,
                        $idea = $this->next($userId, $args[0], $args[1] ?? null);

                        $ideas[$args[0]] = $idea;
                        break;
                    case 'editIdeaTitle':
                        // arg0: ideaId, arg1: title,
                        $idea = $this->titleChange($userId, $args[0], $args[1]);

                        $ideas[] = $idea;
                        break;
                    case 'editIdeaContent':
                        // arg0: ideaId, arg1: contents,
                        $idea = $this->ideaChange($userId, $args[0], $args[1]);

                        $ideas[] = $idea;
                        break;
                    case 'deleteIdea':
                        // arg0: ideaId,
                        // TODO 追加
                        $this->ideaDelete($args[0]);
                        break;
                    case 'editSpaceTitle':
                        // arg0: contents,
                        $this->editSpaceTitle($spaceId, $args[0]);
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

        }

        // TODO なぜTransaction
        return response()->json([
            'code' => 200,
            'data' => $ideas
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

    private function titleChange($userId, $ideaId, $contents)
    {
        // TODO アイデアが存在したら追加
        // args: [追加するid, 一つ前のid]
        $idea = Idea::query()->find($ideaId);

        $idea['title'] = $contents ?? '';

        return $idea;
    }

    private function ideaChange($userId, $ideaId, $contents)
    {
        // TODO アイデアが存在したら追加
        // args: [追加するid, 一つ前のid]
        $idea = Idea::query()->find($ideaId);

        $idea['content'] = $contents ?? '';

        return $idea;
    }

    private function ideaDelete($ideaId): void
    {
        // args: [削除id,]
        Idea::query()->find($ideaId)->delete();
    }

    private function editSpaceTitle($spaceId, $contents)
    {
        // TODO アイデアが存在したら追加
        // args: [追加するid, 一つ前のid]
        $space = Space::query()->find($spaceId);

        $space['title'] = $contents ?? '';

        $space->save();
    }
}
