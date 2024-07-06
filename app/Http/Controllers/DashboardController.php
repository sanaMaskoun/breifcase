<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\UserTypeEnum;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\QuestionReply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function consultations_profits()
    {
        $profits_consultations = Document::where('receiver_id', Auth()->user()->id)
            ->where('answer', '<>', null)
            ->where('status', DocumentStatusEnum::closed)
            ->where('type', DocumentTypeEnum::consultation)
            ->with('receiver')
            ->get()
            ->reduce(function ($total, $consultation) {
                $price = $consultation->receiver->lawyer->consultation_price;
                $discounted_price = $price - ($price * 0.05);
                return $total + $discounted_price;
            }, 0);

        return $profits_consultations;
    }

    public function cases_profits()
    {
        $profits_cases = Document::where('receiver_id', Auth()->user()->id)
            ->where('answer', '<>', null)
            ->where('status', DocumentStatusEnum::closed)
            ->where('type', DocumentTypeEnum::case )
            ->with('receiver')
            ->get()
            ->reduce(function ($total, $case) {
                $price = $case->receiver->lawyer->consultation_price;
                $discounted_price = $price - ($price * 0.03);
                return $total + $discounted_price;
            }, 0);
        return $profits_cases;
    }

    public function revenues()
    {
        $revenues = Document::where('receiver_id', Auth()->user()->id)
            ->where('answer', '<>', null)
            ->where('status', DocumentStatusEnum::closed)
            ->with('receiver')
            ->get()
            ->reduce(function ($total, $revenue) {
                $price = $revenue->receiver->lawyer->consultation_price;
                return $total + $price;
            }, 0);

        return $revenues;
    }
    public function admin_dashboard()
    {
        $num_clients = User::where('is_active', true)->where('type', UserTypeEnum::client)->count();
        $num_lawyers = User::where('is_active', true)->where('type', UserTypeEnum::lawyer)->count();
        $num_companies = User::where('is_active', true)->where('type', UserTypeEnum::translation_company)->count();

        $profits_consultations = Document::where('answer', '<>', null)
        ->where('status', DocumentStatusEnum::closed)
        ->where('type', DocumentTypeEnum::consultation)
        ->with('receiver')
        ->get()
        ->reduce(function ($total, $consultation) {
            $price = $consultation->receiver->lawyer->consultation_price;
            $discounted_price = $price - ($price * 0.95);
            return $total + $discounted_price;
        }, 0);

        $profits_cases = Document::where('answer', '<>', null)
        ->where('status', DocumentStatusEnum::closed)
        ->where('type', DocumentTypeEnum::case )
        ->with('receiver')
        ->get()
        ->reduce(function ($total, $case) {
            $price = $case->receiver->lawyer->consultation_price;
            $discounted_price = $price - ($price * 0.97);
            return $total + $discounted_price;
        }, 0);;
        $profits = $profits_consultations + $profits_cases;


        $num_clients_month = User::where('is_active', true)->where('type', UserTypeEnum::client)
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->groupBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        $num_lawyers_month = User::where('is_active', true)->where('type', UserTypeEnum::lawyer)
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->groupBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        $num_companies_month = User::where('is_active', true)->where('type', UserTypeEnum::translation_company)
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->groupBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        $clients_data = [];
        $lawyers_data = [];
        $companies_data = [];
        for ($i = 1; $i <= 12; $i++) {
            $clients_data[] = $num_clients_month[$i] ?? 0;
            $lawyers_data[] = $num_lawyers_month[$i] ?? 0;
            $companies_data[] = $num_companies_month[$i] ?? 0;
        }
        return view('pages.dashboard.admin', compact('num_clients', 'num_lawyers', 'num_companies', 'profits' ,'clients_data' ,'lawyers_data' ,'companies_data'));
    }
    public function lawyer_dashboard()
    {

        $profits_consultations = $this->consultations_profits();

        $profits_cases = $this->cases_profits();

        $revenues = $this->revenues();

        $profits = $profits_consultations + $profits_cases;

        $revenues == 0 ? $percentage_of_profits = 0 : $percentage_of_profits = ($profits / $revenues) * 100;

        $documents = Document::where('receiver_id', Auth()->user()->id)
            ->where('answer', '<>', null)
            ->where('status', DocumentStatusEnum::closed)
            ->with('receiver')
            ->get()
            ->map(function ($document) {
                $price = $document->receiver->lawyer->consultation_price;
                return [
                    'profit' => $price,
                    'month' => Carbon::parse($document->created_at)->format('Y-m'),
                ];
            });

        $monthly_revenues = $documents->groupBy('month')->map(function ($items) {
            return $items->sum('profit');
        });

        $max_revenue_month_key = $monthly_revenues->keys()->firstWhere(function ($key) use ($monthly_revenues) {
            return $monthly_revenues[$key] == $monthly_revenues->max();
        });

        $max_revenue_month_key == null ? $max_revenue_month = '' : $max_revenue_month = Carbon::parse($max_revenue_month_key . '-01')->format('F Y');
        $max_revenue_month_key == null ? $max_revenue = 0 : $max_revenue = $monthly_revenues[$max_revenue_month_key];

        $consultations = Document::where('receiver_id', Auth()->user()->id)
            ->where('status', DocumentStatusEnum::closed)
            ->where('type', DocumentTypeEnum::consultation)
            ->count();

        $cases = Document::where('receiver_id', Auth()->user()->id)
            ->where('status', DocumentStatusEnum::closed)
            ->where('type', DocumentTypeEnum::case )
            ->count();

        $replies = QuestionReply::where('user_id', Auth()->user()->id)->count();

        $num_replies_month = QuestionReply::where('user_id', Auth()->user()->id)

            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $num_cases_month = Document::where('receiver_id', Auth()->user()->id)
            ->where('type', DocumentTypeEnum::case )
            ->where('status', DocumentStatusEnum::closed)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $num_consultations_month = Document::where('receiver_id', Auth()->user()->id)
            ->where('type', DocumentTypeEnum::consultation)
            ->where('status', DocumentStatusEnum::closed)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $replies_data = [];
        $cases_data = [];
        $consultations_data = [];
        for ($i = 1; $i <= 12; $i++) {
            $replies_data[] = $num_replies_month[$i] ?? 0;
            $cases_data[] = $num_cases_month[$i] ?? 0;
            $consultations_data[] = $num_consultations_month[$i] ?? 0;
        }
        return view('pages.dashboard.lawyer', compact('profits', 'revenues', 'percentage_of_profits',
            'max_revenue_month', 'max_revenue',
            'replies', 'cases', 'consultations',
            'replies_data', 'cases_data', 'consultations_data'));
    }
    public function company_dashboard()
    {

        $profits = Document::where('receiver_id', Auth()->user()->id)
            ->where('answer', '<>', null)
            ->where('status', DocumentStatusEnum::closed)
            ->with('receiver')
            ->get()
            ->reduce(function ($total, $consultation) {
                $price = $consultation->receiver->lawyer->consultation_price;
                $discounted_price = $price - ($price * 0.05);
                return $total + $discounted_price;
            }, 0);

        $revenues = $this->revenues();

        $revenues == 0 ? $percentage_of_profits = 0 : $percentage_of_profits = ($profits / $revenues) * 100;

        $documents = Document::where('receiver_id', Auth()->user()->id)
            ->where('answer', '<>', null)
            ->where('status', DocumentStatusEnum::closed)
            ->with('receiver')
            ->get()
            ->map(function ($document) {
                $price = $document->receiver->lawyer->consultation_price;
                return [
                    'profit' => $price,
                    'month' => Carbon::parse($document->created_at)->format('Y-m'),
                ];
            });

        $monthly_revenues = $documents->groupBy('month')->map(function ($items) {
            return $items->sum('profit');
        });

        $max_revenue_month_key = $monthly_revenues->keys()->firstWhere(function ($key) use ($monthly_revenues) {
            return $monthly_revenues[$key] == $monthly_revenues->max();
        });

        $max_revenue_month_key == null ? $max_revenue_month = '' : $max_revenue_month = Carbon::parse($max_revenue_month_key . '-01')->format('F Y');
        $max_revenue_month_key == null ? $max_revenue = 0 : $max_revenue = $monthly_revenues[$max_revenue_month_key];

        $num_clients = Document::where('receiver_id', Auth()->user()->id)
            ->where('status', DocumentStatusEnum::closed)
            ->where('type', DocumentTypeEnum::translate)
            ->count();

        $num_clients_month = Document::where('receiver_id', Auth()->user()->id)
            ->where('type', DocumentTypeEnum::translate)
            ->where('status', DocumentStatusEnum::closed)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $clients_data = [];

        for ($i = 1; $i <= 12; $i++) {
            $clients_data[] = $num_clients_month[$i] ?? 0;

        }
        return view('pages.dashboard.company', compact('profits', 'revenues', 'percentage_of_profits',
            'max_revenue_month', 'max_revenue',
            'num_clients',
            'clients_data'));
    }
}
