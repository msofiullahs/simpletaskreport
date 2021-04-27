<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;

    public $appends = ['timer'];

    public function task(){
        return $this->belongsTo(Task::class, 'id', 'task_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function getTimerAttribute(){
        $time = Carbon::parse($this->created_at)->diffForHumans();
        return $time;
    }
}
