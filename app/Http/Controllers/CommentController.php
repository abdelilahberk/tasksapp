<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\CommentStatus;
use App\Models\Image;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($task_id, $ticket_id)
    {
        // dd($task_id." ".$ticket_id);
        // $task = Task::with()->where()

        // $taskWithTichetsWithComments = Task::with(["sub_tasks" => function ($query) use ($ticket_id) {
        //     $query->where("id", $ticket_id)->with(["comments"=>function($query2){
        //         $query2->withCount("images");
        //     }]);
        // }, "user"])->where("id", $task_id)->first();
        $taskWithTichetsWithComments = Task::with(["comments" => function ($query) {
            $query->with(["user"])->withCount("images");
        }, "parent_task"])->where("parent_id", $task_id)->where("id", $ticket_id)->first();
        
    
        
      
            
       


        return view("admin.comments.list", [
            "taskWithTichetsWithComments" => $taskWithTichetsWithComments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($task_id, $ticket_id)
    {
        // dd($task_id." ".$ticket_id);
        // $ticket = Task::where("id",$ticket_id)->with("parent_task")->first();
        // dd($ticket->id);
        $ticket = Task::findOrFail($ticket_id);
        return view("admin.comments.create", [
            "ticket" => $ticket,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreCommentRequest $request,$ticket_id)
    public function store(StoreCommentRequest $request, $task_id, $ticket_id)
    {
        // dd($request->name);
        // dd($request->file("image"));

        $ticket = Task::findOrFail($ticket_id);

        $comment = Comment::create([
            "title" => $request->name,
            "description" => $request->description,
            "timing" => number_format($request->timing, 2, ".", ""),
            "task_id" => $ticket->id,
            "user_id" => Auth::user()->id,
        ]);

        if ($request->hasFile("images")) {

            foreach ($request->file("images") as  $file) {
                # code...
                // $file = $request->file("image");
                // dd($file);
                // $path = Storage::disk("public")->putFileAs("comments_images",$file,now().".".$file->guessExtension());
                // $path = Storage::disk("local")->putFileAs("comments_images",$file,\random_int(1,999).".".$file->guessExtension());
                $path = Storage::disk("public")->putFile("comments_images", $file);
                $image = new Image(["url" => $path]);
                $comment->images()->save($image);

                // dd($path);
            }
        }
          
            session()->flash("succes", "L'opération a est été effectué avec succès");
            return redirect()->route("tasks.tickets.comments.edit", ["task" => $task_id, "ticket" => $ticket->id,"comment"=>$comment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($task_id,$ticket_id,$comment_id)
    {
        $comment = Comment::with("images")->find($comment_id);
        // dd($comment);
            //  dd($task_id,$ticket_id,$comment_id);
            return view("admin.comments.edit",[
                "comment" =>$comment
            ]);
             
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $task_id,$ticket_id,$comment_id)
    {

        $comment = Comment::find($comment_id);

        // dd($comment->task->parent_task);
        // dd($comment->task->id);

        $comment->title = $request->name;
        $comment->timing = number_format($request->timing,2,".","");
        $comment->description = $request->description;
        $comment->save();

        if($request->hasFile("images")){
            foreach ($request->file("images") as  $file) {
                $path="";
                $path = Storage::disk("public")->putFile("comments_images",$file);
                $comment->images()->save(new Image(["url"=>$path]));

            }

        }

        session()->flash("succes", "L'opération a est été effectué avec succès");
        return redirect()->route("tasks.tickets.comments.edit", ["task" =>$comment->task->parent_task->id , "ticket" => $comment->task->id,"comment"=>$comment->id]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
