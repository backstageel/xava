<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidaysRequest;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    public function create(){
        return view('holidays.create');
    }

    public function store(HolidaysRequest $request){
        $holiday = new Holiday();
        $holiday->holiday_date = $request->input('holiday_date');
        $holiday->save();
        return redirect()->route('vacation_collectives.index');
    }

    public function edit (Holiday $holiday){
        return view('holidays.edit', compact('holiday'));
    }
    public function update(HolidaysRequest $request, Holiday $holiday){

        $holiday->holiday_date = $request->input('holiday_date');
        $holiday->save();
        return redirect()->route('vacation_collectives.index');
    }
}
