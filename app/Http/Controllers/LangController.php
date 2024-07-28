<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    // public function setLang($locale)
    // {
    //         App::setLocale($locale);
    //         Session::put("locale",$locale);
    //         return redirect()->back();
    // }
    public function setLang($lang)
    {
        Session::put('locale', $lang);
        return redirect()->back();
}
}
