<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $datas = Schedule::where('user_id', auth()->user()->id);

        if ($request->search) {
            $datas->search($request->search);
        }

        if ($request->date) {
            $datas->whereDate('start_date', $request->date)->orWhereDate('end_date', $request->date);
        }

        $datas = $datas->get();

        return view('pages.schedule', compact('datas'));
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $payload['user_id'] = auth()->user()->id;

        if (Schedule::create($payload)) {
            return redirect()->back()->with('success', 'Schedule created successfully');
        }

        return redirect()->back()->withErrors(['error' => 'Failed to create schedule']);
    }

    public function show(Schedule $schedule)
    {
        return view('pages.schedule-detail', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $payload = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($schedule->update($payload)) {
            return redirect()->back()->with('success', 'Schedule updated successfully');
        }

        return redirect()->back()->withErrors(['error' => 'Failed to update schedule']);
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->delete()) {
            return redirect()->route('schedule.index')->with('success', 'Schedule deleted successfully');
        }

        return redirect()->back()->withErrors(['error' => 'Failed to delete schedule']);
    }
}
