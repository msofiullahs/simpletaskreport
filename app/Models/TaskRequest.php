<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskRequest extends Model
{
    use HasFactory;

    public function reporter(){
        return $this->belongsTo(User::class, 'reporter_id', 'id');
    }

    public function assignee(){
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
