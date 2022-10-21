<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "timing",
        "task_id",
        "user_id",
    ];

    public function user(){
        return $this->belongsTo(User::class);
        
    }
    public function comment_status(){
        return $this->belongsTo(CommentStatus::class);
        
    }
    public function task(){
        return $this->belongsTo(Task::class);
        
    }
    
    public function images(){
        return $this->morphMany(Image::class,"imageable");
        // return $this->hasOne(Image::class);
    }

    public static function boot(){
        parent::boot();
        static::deleting(function(Comment $comment){
           $comment->images()->delete();

        });
    }
}
