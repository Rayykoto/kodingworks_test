<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('user')->get();
        if ($tasks->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data task.',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeTask = Task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return response()->json([
            'success' => true,
            'data' => $storeTask,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->first();
        if ($task) {
            return response()->json([
                'success' => true,
                'data' => $task,
            ]);
        }
        return response()->json([
            'success' => false,
            'data' => '',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();
        $task->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return response()->json([
            'success' => true,
            'data' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task tidak ditemukan.',
            ], 404);
        }

        if ($task->status == 'draft') {
            $task->delete();
            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil dihapus.',
            ]);
        } else {
            $this->authorize('delete', $task);
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus tugas ini.',
            ], 403);
        }
    }
}
