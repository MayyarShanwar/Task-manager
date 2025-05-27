<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Output\ConsoleOutput;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = task::latest()->where('user_id', Auth::user()->id)->get();
        return view('welcome', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.addTask');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretaskRequest $request)
    {
        // dd($request);
        $fixedDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $validated = $request->validate([
            'title' => 'required|string',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'days' => 'required_if:one_time,0',
            'started' => 'default:0',
            'single_day' => 'required_if:one_time,1',
            'one_time' => 'required'
        ]);

        $user = Auth::user()->id;
        
        $task = task::create([
            'title' => $request->title,
            'status' => 'Waiting',
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'one_time' => $request->one_time,
            'user_id' => $user,
            'started' => false
        ]);

        if ($request->one_time == 0) {
            
            $task->days = $request->days;
        } else {
            $task->days = [$fixedDays[$request->single_day]];
        }

        $task->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetaskRequest $request, task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        //
    }
}
