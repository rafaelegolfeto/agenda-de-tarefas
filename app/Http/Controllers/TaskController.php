<?php

namespace App\Http\Controllers;

use App\Models\Task;
// use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'image' => 'nullable|image',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $task->image = $imagePath;
        }

        $task->save();

        return redirect()->route('tasks.index');
    }
}
