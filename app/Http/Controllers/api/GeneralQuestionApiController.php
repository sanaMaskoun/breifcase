<?php

namespace App\Http\Controllers\api;

use App\Events\ReplyRateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralQuestionRequest;
use App\Http\Requests\RateReplyGeneralQuestionRequest;
use App\Http\Requests\ReplyGeneralQuestionRequest;
use App\Http\Resources\GeneralQuestionsResource;
use App\Http\Resources\RepliesResource;
use App\Models\GeneralQuestion;
use App\Models\QuestionReply;
use App\Models\User;
use App\Notifications\ReplyRateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class GeneralQuestionApiController extends Controller
{

    public function index()
    {
        $general_questions = GeneralQuestion::with(['user', 'Replies'])->get();
        return response()->json([GeneralQuestionsResource::collection($general_questions)]);
    }
    public function show(User $user)
    {
        $general_questions = GeneralQuestion::with(['Replies'])->where('user_id' , $user->id)->get();
        return response()->json([GeneralQuestionsResource::collection($general_questions)]);
    }
    public function store(GeneralQuestionRequest $request)
    {
        $general_question = GeneralQuestion::create($request->validated());
        return response()->json([new GeneralQuestionsResource($general_question->load('user'))]);
    }
    public function reply(ReplyGeneralQuestionRequest $request , GeneralQuestion $general_question)
    {
        if (Auth()->user()->is_active === 1) {
            $ReplyGeneralQuestion = QuestionReply::create($request->validated());
            return response()->json([new GeneralQuestionsResource($general_question->load(['user','Replies']))]);
        } else {
            return response()->json((['message' => 'This account is inactive']));
        }
    }

    public function rate(RateReplyGeneralQuestionRequest $request , QuestionReply $reply)
    {
         $reply->update(['rate' => $request->rate]);
         $lawyer =User::where('id', $reply->user_id )->get();

         $data = [
             'client_id'          => Auth()->user()->id,
             'client_name'        => Auth()->user()->name,
             'question_id'        => $reply->generalQuestion->id,
             'question'           => $reply->generalQuestion->question,

         ];
         Notification::send($lawyer, new ReplyRateNotification($data));

         event(new ReplyRateEvent($data));

        return response()->json((new RepliesResource($reply->load(['generalQuestion','user']))));

    }
}
