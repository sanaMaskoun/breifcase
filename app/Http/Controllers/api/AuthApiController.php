<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Pusher\PusherException;

class AuthApiController extends Controller
{
    public function pusherAuth(Request $request){
        try {
            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
        } catch (PusherException $e) {
        }
//        if($request->request->get('channel_name') === 'private-chat') {
        return $pusher->socket_auth($request->request->get('channel_name'), $request->request->get('socket_id'));
//        }
        return response()->json([], 400);


    }
}
