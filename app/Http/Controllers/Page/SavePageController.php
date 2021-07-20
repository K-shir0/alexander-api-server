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

            foreach($operations as $operation) {
                $command = $operation['command'];

                $args = $operation['args'];

                // TODO コマンド毎に分岐して処理
                switch ($command) {
                    case 'next':
                        // args: [追加するid, 一つ前のid]
                        $idea = new Idea();

                        // TODO あれば挿入、無ければ最後に追加
                        $idea['id'] = $args[0];

                        // TODO 一つ前のアイデアを探してポジションをセット
                        // TODO 懸念点、positionがずれたときにやばそう
                        if (count($args) >= 2) {
                            $currentIdea = Idea::query()->where('id', '=', $args[1])->first();
                            $idea['user_id'] = $userId;
                            $idea['title'] = '';
                            $idea['status'] = 0;
                            $idea['public'] = false;
                            $idea['position'] = $currentIdea['position'] + 1;
                        }

                        $ideas[$args[0]] = $idea;

                        break;
                }
            }


            // TODO 保存処理
            foreach ($ideas as $idea) {
                $idea->save();
                // アソシエーション
                $idea->spaces()->syncWithoutDetaching([$spaceId]);
            }

        });

        return response()->json([
            'code' => 200,
            'data' => $transactions
        ]);
//        $spaceId = $request->spaceId;

        // TODO アイデアの作成

        // TODO シンクする

//        $authUser = Auth::id();
//        $addIdea = new Idea(['id' => 'aaa', 'position' => 0, 'user_id' => $authUser, 'title' => '', 'status' => 0, 'public' => false]);
//
//        $addIdea->save();

//        $idea = Idea::query()->find($request->id)->addSibling($addIdea);

//        dd($idea);


        // addSiblings(array $siblings, $from = null);
    }
}
