<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Models\News;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;

class NavbarController extends Controller
{

    public function home()
    {
        $news = News::all();
        return view('pages.home', compact('news'));
    }
    public function explore_lawyer(Request $request)
    {
        $practices = Practice::all();
        $query = User::whereIn('type', [UserTypeEnum::lawyer, UserTypeEnum::translation_company])
            ->where('is_active', true);
        if ($request->has('practice_id')) {
            $query->whereHas('practices', function ($query) use ($request) {
                $query->where('practices.id', $request->practice_id);
            });
        }
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        if ($request->has('available') && $request->available == 1) {

            $query->whereHas('lawyer' , function($q)
            {
              return $q->where('available', true);
            });

        }
        $lawyers = $query->get();

        if ($request->ajax()) {
            $lawyers = $query->get()->map(function ($lawyer) {
                return [
                    'lawyer_encoded_id' => base64_encode($lawyer->id),
                    'name' => $lawyer->name,
                    'profile_url' => $lawyer->getFirstMediaUrl('profile'),
                ];
            });
            return response()->json(['lawyers' => $lawyers]);
        }

        return view('pages.navbar.explore_lawyer', compact('practices', 'lawyers'));
    }

    public function explore_translation_company()
    {
        return view('pages.navbar.explore_translation_company');

    }
}
