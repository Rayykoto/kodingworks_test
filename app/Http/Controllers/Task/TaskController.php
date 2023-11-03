<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Notifications\AssignTask;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->get();
        return Inertia::render('admin/task/index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        $users = User::get();
        return Inertia::render('admin/task/create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $receivertask = User::where('id', $request->user_id)->first();
        $id_task = new Task;
        $id_task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $this->send_to_user($receivertask, $id_task);
        return redirect()->route('task.index');
    }

    function send_to_user($receivertask, $tasks)
    {
        $task = [
            'mail_to'   => $receivertask->email,
            'title'     => 'title tes',
            'greeting'  => 'ada task nih',
            'detail'    => 'for what???',
            'body'      => 'isi data taks',
            'actionURL' => url('http://kotonotes.com/' . $tasks->id),
            'actionText' => 'View Taksk',
            'id' => $tasks->id
        ];
        FacadesNotification::send($receivertask, new AssignTask($task));
    }

    public function edit($id)
    {
        $users = User::get();
        $task = Task::where('id', $id)->first();
        if ($task->status == 'draft') {
            return Inertia::render('admin/task/edit', [
                'task' => $task,
                'users' => $users
            ]);
        } else {
            $this->authorize('edit', $task);
        }
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();
        $task->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('task.index');
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();
        if ($task->status == 'draft') {
            $task->delete();
            return redirect()->route('task.index');
        } else {
            $this->authorize('delete', $task);
        }
    }
}
