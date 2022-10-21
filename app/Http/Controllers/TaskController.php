<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $task = Task::where("parent_id","=",null)->with(["children_recurssive"])->withCount("sub_tasks")->get();

        // dd($task);


        // $tasks = Task::onlyTrashed()->where("parent_id","=",null)->withCount("sub_tasks")->with(["sub_tasks"=>function($query){
        //     $query->onlyTrashed();
        // }])->get();

        // $tasks = Task::onlyTrashed()->where("parent_id","=",null)->withCount("sub_tasks")->with(["sub_tasks"])->get();

        // $tasks = Task::onlyTrashed()->where("parent_id","=",null)->withCount(["sub_tasks"])->with("sub_tasks")->get();
        // dd($tasks);
        $tasks = Task::where("parent_id", "=", null)->withCount("sub_tasks")->get();
        // dd($tasks);
        return view("admin.tasks.list", [
            "tasks" => $tasks,
        ]);
    }

    public function statistics(){
        $task_types = TaskType::withCount("tasks")->get();
        // dd($task_types);
        return view("admin.dashboard.index",[
            "task_types"=>$task_types
        ]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks_type = TaskType::all();
        $task_status = TaskStatus::all();
        $users = User::all();
        return view("admin.tasks.create", [
            "task_types" => $tasks_type,
            "task_status" => $task_status,
            "users" => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        // dd($request); 

        $task = new Task();
        $task->title = $request->name;
        $task->task_type_id = $request->task_type_id;
        $task->task_status_id = $request->task_status_id;
        // $task->date_debut = $request->date_debut ?? null;
        // $task->date_fin = $request->date_fin ?? null;
        $task->description = $request->description ?? null;
        $task->user_id = Auth::user()->id;
        $task->save();

        session()->flash("succes","L'opération a est été effectué avec succès");
        return redirect()->route("tasks.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $task_types = TaskType::all();
        $task_status = TaskStatus::all();

        return view("admin.tasks.edit", [
            "task_types" => $task_types,
            "task_status" => $task_status,
            "task" => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->title = $request->name;
        $task->description = $request->description;
        $task->task_type_id = $request->task_type_id;
        $task->task_status_id = $request->task_status_id;
        $task->save();

        session()->flash("succes","L'opération a est été effectué avec succès");
        return redirect()->route("tasks.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        // dd($task->sub_tasks[0]->images());
        // DB::transaction(function()use($task){
            $task->delete();
            // $task->sub_tasks()->delete();
            // $task->sub_tasks()->images()->delete();
            // $task->sub_tasks()->comments()->delete();
            // $task->sub_tasks()->comments()->images()->delete();
            return redirect()->route("tasks.index");
        // });
      
    }
}
