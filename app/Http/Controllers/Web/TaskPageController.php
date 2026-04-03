<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskPageController extends Controller
{
    public function index(Request $request)
    {
        return view('tasks.index', ['tasks' => $request->user()->tasks]);
    }

    public function toggle(Request $request, int $taskId)
    {
        $task = $request->user()->tasks()->findOrFail($taskId);
        $task->is_completed = ! $task->is_completed;
        $task->save();

        return response()->json([
            'status' => $task->is_completed ? 'Completed' : 'Pending'
        ]);
    }

    public function addTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $request->input('title'),
            'is_completed' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'task' => $task
        ]);
    }

    public function deleteTask(Request $request, int $taskId)
    {
        $task = $request->user()->tasks()->findOrFail($taskId);
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ]);
    }
}
