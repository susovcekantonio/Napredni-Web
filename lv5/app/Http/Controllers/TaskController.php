<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\MassAssignmentException;

class TaskController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $tasks = $user->createdTasks->filter(function ($task) {
            return $task->appliedStudents()->exists();
        });
        return view('task.index', ['tasks' => $tasks]);
    }

    public function allTasks()
    {
        $tasks = Task::all();
        return view('task.all_tasks', ['tasks' => $tasks]);
    }

    public function create()
    {
        $task = new Task();
        return view('task.create', ['task' => $task]);
    }

    public function store(Request $request)
    {
        $post = $request->except('_token');
        $user = User::find(Auth::id());
        try {
            $user->createdTasks()->create($post);
            return back()->with('message', 'Work created successfully');
        } catch (MassAssignmentException $e) {
            return back()->with('message', 'Failed to create Work');
        }
    }

    public function apply(Task $task)
    {
        $user = Auth::user();

        if ($task->appliedStudents()->where('user_id', $user->id)->exists()) {
            return back()->with('message', 'You have already applied for this task.');
        }

        $task->appliedStudents()->attach($user);

        return back()->with('message', 'You have successfully applied for the task.');
    }

    public function appliedStudents(Task $task)
    {
        $appliedStudents = $task->appliedStudents()->get();
        return view('task.applied_students', ['appliedStudents' => $appliedStudents, 'task' => $task]);
    }
}
