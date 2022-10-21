<?php

namespace App\Models;

use App\Scopes\LatestScope ;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory
    ,SoftDeletes;

    protected $fillable =[
        "title",
        "task_type_id",
        "task_status_id",
        "description",
        "user_id",
    ];

    public function task_type(){
        return $this->belongsTo(TaskType::class);
    }
    public function task_status(){
        return $this->belongsTo(TaskStatus::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function images(){
        return $this->morphMany(Image::class,"imageable");
    }

    public function sub_tasks_trashed(){
        return $this->hasMany(Task::class,"parent_id")->onlyTrashed();

    }
    public function sub_tasks(){
        return $this->hasMany(Task::class,"parent_id");

    }

    public function parent_task(){
        return $this->belongsTo(Task::class,"parent_id");
    }

    public function  children_recurssive(){
        return $this->sub_tasks()->with("children_recurssive");

    }

    public function users(){
        return $this->belongsToMany(User::class);
        
    }

    public function scopeGetAllSubTasks(Builder $query){
            return $query->with("sub_tasks");
    } 

    public static function boot(){
            parent::boot();
            static::addGlobalScope(new LatestScope);


            static::deleting(function(Task $task){
                foreach ($task->sub_tasks as $ticket) {
                    $ticket->images()->delete();
                    foreach ($ticket->comments as $comment) {
                        $comment->images()->delete();
                    }
                    $ticket->comments()->delete();
                }
                $task->sub_tasks()->delete();

            });
    }
}
