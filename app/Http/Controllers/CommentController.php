<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $task = Task::find($id);
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->task_id = $task->id;
        $comment->content = $request->content;

        if ($comment->save()) {
            return redirect()->route('task.show', ['task'=>$task->id])->with('message', 'you have successfully added new task');
        }else{
            return redirect()->route('task.show', ['task'=>$task->id])->with('message', 'sorry, you have unsuccessfully added new task');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $comment)
    {
        $task = Task::find($id);
        $comment = Comment::find($comment);
        if ($comment->delete()) {
            return redirect()->route('task.show', ['task'=>$task->id])->with('message', 'you have successfully added new task');
        }else{
            return redirect()->route('task.show', ['task'=>$task->id])->with('message', 'sorry, you have unsuccessfully added new task');
        }
    }

    public function commentModal($id){
        $task = Task::find($id);
        $comments = $task->comments;
        $html = view('partials.comments', compact('comments', 'task'))->render();
        return response()->json(['html'=>$html]);
    }
}
