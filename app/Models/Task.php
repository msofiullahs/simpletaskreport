<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function reporter(){
        return $this->belongsTo(User::class, 'reporter_id', 'id');
    }

    public function assignee(){
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function asked(){
        if(!empty($this->request_id)){
            return $this->hasOne(TaskRequest::class, 'id', 'request_id');
        }
        return null;
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'task_id', 'id')->orderBy('created_at', 'DESC');
    }
}
