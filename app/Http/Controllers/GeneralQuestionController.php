<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\GeneralQuestionRequest;
use App\Http\Requests\ReplyGeneralQuestionRequest;
use App\Models\GeneralQuestion;
use App\Models\QuestionReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralQuestionController extends Controller
{

    public function list_admin()
    {
        $questions = GeneralQuestion::paginate(config('constants.PAGINATION_COUNT'));
        $num_questions = GeneralQuestion::count();
        return view('pages.generalQuestion.listAdmin', compact(['questions', 'num_questions']));

    }
    public function index(Request $request, $user_encoded_id = null)
    {
        $user_decoded_id = base64_decode($user_encoded_id);

        if ($user_decoded_id) {

            $user = User::find($user_decoded_id);
            if ($user->type == UserTypeEnum::client) {
                $client = $user;
                $questions = GeneralQuestion::where('sender_id', Auth()->user()->id)->get();
                return view('pages.generalQuestion.profileList', compact('questions', 'client'));
            }

            if ($user->type == UserTypeEnum::lawyer) {
                $general_questions = GeneralQuestion::whereHas('replies', function ($query) {
                    return $query->where('user_id', Auth()->user()->id);
                });

                $questions = $general_questions->get();
                $num_questions = $general_questions->count();

                return view('pages.generalQuestion.dashboardList', compact('questions', 'num_questions'));

            }
            if ($user->type == UserTypeEnum::translation_company) {
                $general_questions = GeneralQuestion::where('sender_id', Auth()->user()->id);

                $questions = $general_questions->get();
                $num_questions = $general_questions->count();

                return view('pages.generalQuestion.dashboardList', compact('questions', 'num_questions'));

            }
        } else {
            $questions = GeneralQuestion::paginate(config('constants.PAGINATION_COUNT'));
            return view('pages.generalQuestion.list', compact('questions'));

        }

    }

    public function home()
    {
        $questions = GeneralQuestion::all();
        return view('pages.generalQuestion.list', compact('questions'));

    }
    public function create()
    {
        if (Auth()->user()->type == UserTypeEnum::client) {$client = Auth()->user();
            return view('pages.generalQuestion.create', compact('client'));} else {
            return view('pages.generalQuestion.company.create');
        }
    }

    public function store(GeneralQuestionRequest $request)
    {
        GeneralQuestion::create($request->validated());
        $user_encoded_id = base64_encode(Auth()->user()->id);

        return redirect()->route('list_general_questions', $user_encoded_id);
    }

    public function reply($encoded_general_question)
    {
        $decoded_general_question = base64_decode($encoded_general_question);
        $question = GeneralQuestion::find($decoded_general_question);
        return view('pages.generalQuestion.reply', compact('question'));
    }

    public function store_reply(ReplyGeneralQuestionRequest $request, GeneralQuestion $general_question)
    {
        QuestionReply::create($request->validated());
        return view('pages.thankyou');
    }
    public function show($question_encoded_id)
    {
        $question_decoded_id = base64_decode($question_encoded_id);
        $question = GeneralQuestion::find($question_decoded_id);

        // $get_notify = DB::table('notifications')->where('data->question_id', $general_question->id)->where('notifiable_id', Auth()->user()->id)->first();
        // if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}
        return view('pages.generalQuestion.details', compact('question'));
    }
}
