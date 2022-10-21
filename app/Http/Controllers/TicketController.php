<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Image;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($task_id)
    {
        $task = Task::where("id", $task_id)->with(["sub_tasks" => function ($query) {
            $query->with(["users"])->withCount("comments");
        }])->first();

        // dd($task);
        // dd($task->sub_tasks[1]->users);

        return view("admin.tickets.list", [
            "task" => $task
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($task_id)
    {
        $task = Task::findOrFail($task_id);
        $users = User::all();
        return view("admin.tickets.create", [
            "task" => $task,
            "users" => $users,

        ]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request, $task_id)
    {

        // dd($request);
        $task = Task::findOrFail($task_id);

        $newnewtask = $task->sub_tasks()->save(new Task([
            "title" => $request->ticket_name,
            "description" => $request->description,
            "user_id" => Auth::user()->id,
        ]));
        // dd();
        $newnewtask->users()->sync($request->user_id);
        //    dd($newnewtask);





        session()->flash("succes", "L'opération a est été effectué avec succès");
        return redirect()->route("tasks.tickets.index", ["task" => $task->id]);



        // dump($task_id);
        // dd($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($task_id, $ticket_id)
    {

        $ticket = task::with("users", "images")->where("id", $ticket_id)->where("parent_id", $task_id)->first();
        $users = User::all();
        return view("admin.tickets.edit", [
            "users" => $users,
            "ticket" => $ticket
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(UpdateTicketRequest $request, $task_id,$ticket_id)
    {
        // dd($task_id." ".$ticket_id);
        // dd($request);
        // dd($request);

        $ticket = Task::with("users")->where("id",$ticket_id)->where("parent_id",$task_id)->first();
        // dd($ticket);
        $ticket->title = $request->ticket_name;
        $ticket->description = $request->description;
        $ticket->save();


        if ($request->hasFile("images")) {
            // dd("aaa");
            foreach ($request->file("images") as $file) {
                $path = Storage::disk("public")->putFile("tickets_images",$file);
                $ticket->images()->save(new Image(["url"=>$path]));

            }

        }

        $ticket->users()->sync($request->user_id);
        session()->flash("succes","L'opération a est été effectué avec succès");
        // return redirect()->route("tasks.tickets.index", ["task" => $task->id]);

        // return redirect()->route("tasks.tickets.index",["task"=>$task_id]);
        return redirect()->route("tasks.tickets.edit",["task"=>$task_id,"ticket"=>$ticket->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
