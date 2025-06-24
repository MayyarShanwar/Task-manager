<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use App\Notifications\TaskCreated;
use App\Notifications\TaskDeleted;
use App\Notifications\TaskNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Output\ConsoleOutput;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // $user->notify(new TaskNotify($user->first_name, $user->email));
        $unreadNotifications = $user->unreadNotifications;
        $readNotifications = $user->readnotifications()->limit(10)->get();
        $notifications = [...$unreadNotifications, ...$readNotifications];
        $tasks = [];
        if (request('filter')) {
            $tasks = task::latest()->where(['user_id' => $user->id, 'status' => request('filter')])->get();
            return view('welcome', ['tasks' => $tasks, 'notifications' => $notifications]);
        } else {
            $tasks = task::latest()->where(['user_id' => $user->id])->get();
        }

        return view('welcome', ['tasks' => $tasks, 'notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $unreadNotifications = $user->unreadNotifications;
        $readNotifications = $user->readnotifications()->limit(10)->get();
        $notifications = [...$unreadNotifications, ...$readNotifications];
        return view('task.addTask',['notifications' => $notifications ]);
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

        $user = Auth::user();

        $task = task::create([
            'title' => $request->title,
            'status' => 'Waiting',
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'one_time' => $request->one_time,
            'user_id' => $user->id,
            'started' => false
        ]);

        if ($request->one_time == 0) {

            $task->days = $request->days;
        } else {
            $task->days = [$fixedDays[$request->single_day]];
        }

        $task->save();
        
        $user->notify(new TaskCreated($request->title));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        $user = Auth::user();
        $unreadNotifications = $user->unreadNotifications;
        $readNotifications = $user->readnotifications()->limit(10)->get();
        $notifications = [...$unreadNotifications, ...$readNotifications];
        $taask = task::find($task)->first();
         
        return view('task.show',['task' => $taask ,'notifications' => $notifications]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        $user = Auth::user();
        $unreadNotifications = $user->unreadNotifications;
        $readNotifications = $user->readnotifications()->limit(10)->get();
        $notifications = [...$unreadNotifications, ...$readNotifications];
        $taask = task::find($task)->first();
         
        return view('task.editTask',['task' => $taask ,'notifications' => $notifications]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(task $task)
    {
        $fixedDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        request()->validate([
            'title' => 'required|string',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'days' => 'required_if:one_time,0',
            'started' => 'default:0',
            'single_day' => 'required_if:one_time,1',
            'one_time' => 'required'
        ]);

        $user = Auth::user();


        $task->update([
            'title' => request()->title,
            'status' => 'Waiting',
            'time_start' => request()->time_start,
            'time_end' => request()->time_end,
            'one_time' => request()->one_time,
            'user_id' => $user->id,
            'started' => false
        ]);

        if (request()->one_time == 0) {

            $task->days = request()->days;
        } else {
            $task->days = [$fixedDays[request()->single_day]];
        }

        $task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        $title = $task->title;
        // $console = new ConsoleOutput();
        // $console->writeln($task);
        // $console->writeln($taskDelete);
        $task->delete();
        Auth::user()->notify(new TaskDeleted($title));
        return redirect('/');
    }

    public function markAllAsRead()
    {

        $user = Auth::user();
        // $user->notify(new TaskNotify($user->first_name,$user->email));
        $user->unreadNotifications->markAsRead();
        $notifications = $user->notifications;
        return back()->with('notifications',$notifications);
    }

    public function showAll()
    {

        $user = Auth::user();
        // $user->notify(new TaskNotify($user->first_name,$user->email));
        $notifications = $user->notifications()->paginate(10);
        return view('notifications',['notifications' => $notifications]);
    }

    public function startTask(task $task)
    {
        
        $taask = task::where(["id"=>$task->id])->get()->first();
        $taask->update([
            'started' => 1,
            'status' => 'In Progress'
        ]);
        $taask->save();
        $console = new ConsoleOutput();
        $console->writeln($taask->title);
        return redirect("/task/{$taask->id}");
    }
}
