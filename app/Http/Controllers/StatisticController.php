<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function updateAnswers(Request $request)
    {
        $stat = Statistic::first();
        $stat->sum_of_answers++;
        if ($request->isRight) {
            $stat->num_of_correct_answers++;
        }
       return $stat->save();
    }

    public function updateFinishedStatus(Request $request){
        $stat = Statistic::first();
        if ($request->isFinished) {
            $stat->num_of_finished++;
        }
        $stat->save();
    }
}
