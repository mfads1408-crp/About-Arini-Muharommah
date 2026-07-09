<?php

namespace App\Http\Controllers;

use App\Models\PeriodTracker;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class PeriodTrackerController extends Controller
{
    public function index()
    {
        $periods = auth()->user()->periodTrackers()->orderBy('start_date', 'desc')->get();
        
        // Calculate next predicted period (simple 28 days calculation based on latest period)
        $latestPeriod = $periods->first();
        $nextPeriodDate = null;
        if ($latestPeriod) {
            $nextPeriodDate = Carbon::parse($latestPeriod->start_date)->addDays(28)->format('Y-m-d');
        }

        return Inertia::render('Periods/Index', [
            'periods' => $periods,
            'nextPeriodDate' => $nextPeriodDate
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'flow_intensity' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        auth()->user()->periodTrackers()->create($validated);
        return back();
    }

    public function destroy(PeriodTracker $period)
    {
        if ($period->user_id === auth()->id()) {
            $period->delete();
        }
        return back();
    }
}
