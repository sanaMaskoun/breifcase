<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function list(Request $request)
    {

        $news = News::query();

        $news = $news->paginate(config('constants.PAGINATION_COUNT'));
        $num_news = News::count();

        return view('pages.news.list', compact(['news', 'num_news']));
    }

    public function show($news_encode_id)
    {
        $news = News::find(base64_decode($news_encode_id));

        if (Auth()->user()?->id == UserTypeEnum::lawyer || Auth()->user()?->id == UserTypeEnum::admin || Auth()->user()?->id == UserTypeEnum::translation_company) {
            return view('pages.news.show', compact('news'));
        } else {
            return view('pages.news.showClient', compact('news'));
        }

    }
    public function create()
    {
        return view('pages.news.create');
    }

    public function store(NewsRequest $request)
    {
        $news = News::create($request->validated());
        if (!is_null(request()->file('news'))) {
            $news->addMediaFromRequest('news')->toMediaCollection('news');
        }
        return redirect()->route('list_news');

    }
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('list_news')
            ->with('success', __('message.delete'));
    }

    public function index()
    {
        $news = News::all();
        return response()->json(NewsResource::collection($news->load('user')));
    }
}
