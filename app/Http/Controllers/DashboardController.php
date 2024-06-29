<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Practice;
use App\Models\QuestionReply;
use App\Models\User;

class DashboardController extends Controller
{

    public function lawyer_dashboard()
    {
        return view('pages.dashboard.lawyer');
    }
}
