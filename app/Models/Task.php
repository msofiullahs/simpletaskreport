<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function reporter(){
        return $this->hasOne(User::class, 'id', 'reporter_id');
    }

    public function assignee(){
        return $this->hasOne(User::class, 'id', 'assignee_id');
    }

    public function asked(){
        if(!empty($this->request_id)){
            return $this->hasOne(TaskRequest::class, 'id', 'request_id');
        }
        return null;
    }
}
