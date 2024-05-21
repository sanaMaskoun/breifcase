<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Pusher\PusherException;

class AuthApiController extends Controller
{
    public function pusherAuth(Request $request)
    {
        try {
            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
        } catch (PusherException $e) {
        }
       // if($request->request->get('channel_name') === 'private-chat') {
        return $pusher->socket_auth($request->request->get('channel_name'), $request->request->get('socket_id'));
      // }
        return response()->json([], 400);

    }


    public function getPusherConfig(Request $request)
    {
        $pusherOptions = [
            // 'host' => 'example.com',
            'wsPort' => 6001,

            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,

            'encrypted' => false,
            'auth' => [
                'endpoint' =>  url('/api/pusher/auth'),
                'headers' => [
                    'Authorization' => 'Bearer ' .  $request->user()->currentAccessToken()->token,
                ],
            ],
        ];

        $pusherConfig = [
            'appKey' => env('PUSHER_APP_KEY'),
            'options' => $pusherOptions,
            'autoConnect' => false,
        ];

        return response()->json($pusherConfig);
    }
}
