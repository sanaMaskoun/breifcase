<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Practice;
use App\Models\QuestionReply;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $lawyers = User::where('is_active', true)->whereHas('roles', function ($query) {
            $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
        })->count();
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();

        $practices = Practice::count();
        $consultations = Consultation::count();

        return view('pages.adminDashboard', compact(['lawyers', 'clients', 'practices', 'consultations']));
    }

    public function adminProfits()
    {
        $monthlyProfits = [];

        for ($month = 1; $month <= 12; $month++) {
            $profitsPerMonth = Consultation::whereMonth('created_at', $month)
                ->with('receiver')
                ->get()
                ->map(function ($consultation) {
                    return $consultation->receiver->consultation_price * 0.05;
                });

            $monthlyProfit = $profitsPerMonth->sum();
            $monthlyProfits[] = $monthlyProfit;
        }
        return response()->json($monthlyProfits);
    }

    public function numberOfSubscribers()
    {
        $monthlyLawyers = [];
        $monthlyClients = [];
        for ($month = 1; $month <= 12; $month++) {
            $lawyers = User::whereMonth('created_at', $month)
                ->whereHas('roles', function ($query) {
                    $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
                })->count();
            $clients = User::whereMonth('created_at', $month)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'client');
                })->count();
            $monthlyLawyers[] = $lawyers;
            $monthlyClients[] = $clients;
        }
        return response()->json([$monthlyLawyers, $monthlyClients]);

    }

    public function lawyerDashboard()
    {

        $consultations = Consultation::where('receiver_id', Auth()->user()->id)->count();
        $replies = QuestionReply::where('user_id', Auth()->user()->id)->count();
        $practices = Auth()->user()->practices->count();

        return view('pages.lawyerDashboard', compact(['replies', 'practices', 'consultations']));
    }

    public function lawyerProfits()
    {
        $monthlyProfits = [];

        for ($month = 1; $month <= 12; $month++) {
            $profitsPerMonth = Consultation::where('receiver_id', Auth()->user()->id)->whereMonth('created_at', $month)
                ->with('receiver')
                ->get()
                ->map(function ($consultation) {
                    return ($consultation->receiver->consultation_price - $consultation->receiver->consultation_price * 0.05);
                });

            $monthlyProfit = $profitsPerMonth->sum();
            $monthlyProfits[] = $monthlyProfit;
        }
        return response()->json($monthlyProfits);
    }

    public function numberOfClients()
    {
        $monthlyClients = [];
        for ($month = 1; $month <= 12; $month++) {

            $clients = Consultation::where('receiver_id', Auth()->user()->id)->whereMonth('created_at', $month)
                ->count();
            $monthlyClients[] = $clients;
        }
        return response()->json($monthlyClients);

    }
}
