<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        "url",
        "comment_id",
    ];


    public function url(){
        return Storage::disk("public")->url($this->url);
    }

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function imageable(){
        return $this->morphs();
    }
}
