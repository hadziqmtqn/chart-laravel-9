<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function chart1()
    {
        $months = [];

        for ($m=1; $m<=12; $m++) {
            $months[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        $user = [];

        foreach ($months as $value) {
            $user[] = User::where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
            ->count();
        }

        return view('chart1')->with('months',json_encode($months,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));;
    }

    public function chart2()
    {
        $months = [];

        for ($m=1; $m<=12; $m++) {
            $months[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        $users = [];
        foreach ($months as $key => $value) {
            $users[] = User::where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
            ->whereYear('created_at', date('Y'))
            ->count();
        }

        
        return view('chart2', compact('users','months'));
    }

    public function chart3()
    {
        $months = [];

        for ($m=1; $m<=12; $m++) {
            $months[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        $users = [];
        foreach ($months as $key => $value) {
            $users[] = User::where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
            ->whereYear('created_at', date('Y'))
            ->count();
        }
          
        return view('chart3', compact('users'));
    }
}
