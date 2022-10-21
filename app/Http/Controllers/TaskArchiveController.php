<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks_archive = Task::withTrashed()->with(["sub_tasks_trashed"])->where("parent_id",null)->get();
        // DB::enableQueryLog();
        $tasks_archive = Task::onlyTrashed()->with(["sub_tasks"=>function($query){
            $query->onlyTrashed();
        },])->where("parent_id",null)->withCount("sub_tasks")->get();

        // dd(DB::getQueryLog());
        // $tasks_archive = Task::onlyTrashed()->with(["sub_tasks"=>function($query){
        //     $query->onlyTrashed();
        // }])->where("parent_id",null)->get();
        // dd($tasks_archive);
        return view("admin.tasks.list", [
            "tasks" => $tasks_archive,
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
        //
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
        //
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
