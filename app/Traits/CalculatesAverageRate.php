<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CalculatesAverageRate
{
    public function calculateAverageRate($lawyerId)
    {
        $averageRate = DB::table('rates')
            ->where('lawyer_id', $lawyerId)
            ->select(DB::raw('(AVG(understanding) + AVG(problem_solving) + AVG(response_time) + AVG(communication)) / 4 as average_rate'))
            ->value('average_rate');

        return number_format($averageRate, 1);
    }
}
