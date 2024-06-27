<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Models\Language;
use App\Models\Library;
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
        $languages = Language::all();

        $query = User::where('type', UserTypeEnum::lawyer)
            ->where('is_active', true);

        if ($request->has('practice_id') && $request->practice_id) {
            $query->whereHas('practices', function ($query) use ($request) {
                $query->where('practices.id', $request->practice_id);
            });
        }

        if ($request->has('language_id') && $request->language_id) {
            $query->whereHas('languages', function ($query) use ($request) {
                $query->where('languages.id', $request->language_id);
            });
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        if ($request->has('available') && $request->available == 1) {
            $query->whereHas('lawyer', function ($q) {
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

        return view('pages.navbar.explore_lawyer', compact('practices', 'lawyers', 'languages'));
    }
    public function explore_translation_company(Request $request)
    {
        $languages = Language::all();
        $query = User::where('is_active', true)
            ->where('type', UserTypeEnum::translation_company);

        if ($request->has('languages')) {
            $languageIds = $request->input('languages');
            if (!empty($languageIds)) {
                $query->whereHas('languages', function ($query) use ($languageIds) {
                    $query->whereIn('languages.id', $languageIds)
                          ->groupBy('users.id')
                          ->havingRaw('COUNT(DISTINCT languages.id) = ?', [count($languageIds)]);
                });
            }
        }

        $translation_companies = $query->get();

        if ($request->ajax()) {
            $translation_companies = $translation_companies->map(function ($company) {
                return [
                    'company_encoded_id' => base64_encode($company->id),
                    'name' => $company->name,
                    'profile_url' => $company->getFirstMediaUrl('profile'),
                ];
            });
            return response()->json(['translation_companies' => $translation_companies]);
        }

        return view('pages.navbar.explore_translation_company', compact('languages', 'translation_companies'));
    }

    public function library()
    {
        $books = Library::all();
        return view('pages.library', compact('books'));

    }

    public function download_book(Request $request)
    {
        $request->validate([
            'book' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $tilte = $request->file('book')->getClientOriginalName();

        $book = Library::create(['title' => $tilte,
            'user_id' => Auth()->user()->id,
        ]);

        $book->addMediaFromRequest('book')->toMediaCollection('library');
        return redirect()->back();
    }

}
