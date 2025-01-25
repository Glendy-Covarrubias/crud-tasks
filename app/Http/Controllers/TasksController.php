<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Inertia\Inertia;
//use DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::all();
        //$tasks = Tasks::select('tasks.name', 'tasks.is_completed');
        //$tasks = Tasks::select('tasks.name', 'tasks.is_completed', 'users.name as user')->join('users', 'users.id', '=', 'tasks.user_id')->paginate(10);
        //$users = Users::all();
        //return Inertia::render('Tasks/Index', ['tasks' => $tasks, 'users' => $users]); 
        return Inertia::render('Tasks/Index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:100']);
        $tasks = new Tasks(
            $request->input()
        );
        $tasks->save();
        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $task)
    {
        return Inertia::render('Tasks/Edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $task)
    {
        $request->validate(['name' => 'required|max:100']);
        $task-> update($request->all());
        return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect('tasks');
    }

    /**
     * Change the status of a task to completed or not completed.
     */
    public function changeStatusCompleted(Request $request, $id, $is_completed)
    {
        // Mostrar la entrada recibida
        //dd($is_completed); // muestrame lo enviando

        // Buscar la tarea por su ID
        $task = Tasks::findOrFail($id);

        // Actualizar el estado
        $task->update([
            'is_completed' => !$is_completed,
        ]);

        // Redirigir con un mensaje de éxito
        //return redirect('tasks')->with('success', 'El estado de la tarea se actualizó correctamente.');
        return redirect('tasks');
    }
}
