<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
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
        Task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('task.index');
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
