<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class RealtimeEcho implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(){
        //
    }

    public function broadcastOn(){
        return new Channel('public-echo-channel');
    }

    public function broadcastWith(){
        return ['count' => Redis::get('count')
            ,'static' => 'STATIC STRING'
        ];
    }
}
