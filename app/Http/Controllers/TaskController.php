<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function create()
    {
        // dd('Caiu aqui');
        return Inertia::render('Tasks/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            // 'image' => 'nullable|image',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->user_id = Auth::id();

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('public/images');
        //     $task->image = $imagePath;
        // }

        $task->save();

        // return response()->json(['success' => true, 'url' => route('tasks.tasklist')]);
        return response()->json(['message' => 'Tarefa criada com sucesso!', 'url' => route('tasks.tasklist')]);

        // return redirect()->route('tasks.tasklist');
    }

    public function tasklist()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->orderBy('due_date')->get();
        return Inertia::render('Tasks/TaskList', ['tasks' => $tasks]);
    }

    public function show($id)
    {
        // $task = Task::findOrFail($id);
        // return Inertia::render('Tasks/TaskDetails', ['task' => $task]);

        $task = Task::findOrFail($id);
        $this->authorize('view', $task); // Verifica se o usuário tem permissão para visualizar a tarefa
        return Inertia::render('Tasks/TaskDetails', ['task' => $task]);
    }

    public function markCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = true;
        $task->save();
        $task->refresh(); // Carrega os dados atualizados da tarefa do banco de dados

        return redirect()->back();
    }


    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.tasklist');
    }
}
