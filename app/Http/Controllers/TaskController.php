<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\TaskDataTable;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskDataTable $dataTable, Request $request)
    {
        return $dataTable->with('request',$request)->render('task.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('task.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'reported_at' => 'required|date',
            'type' => 'required'
        ]);

        $task = new Task();
        $task->reported_at = $request->reported_at;
        $task->title = $request->title;
        $task->detail = $request->detail;
        $task->hours = $request->hours;
        $task->reporter_id = $request->reporter;
        $task->assignee_id = $request->assignee;
        $task->priority = $request->priority;
        $task->type = $request->type;

        if ($task->save()) {
            return redirect()->route('task.index')->with('message', 'you have successfully added new task');
        }else{
            return redirect()->route('task.index')->with('message', 'sorry, you have unsuccessfully added new task');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $task = Task::findOrFail($id);
        return view('task.form', compact('users', 'task'));
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
        $task = Task::find($id);
        $task->reported_at = $request->reported_at;
        $task->title = $request->title;
        $task->detail = $request->detail;
        $task->hours = $request->hours;
        $task->reporter_id = $request->reporter;
        $task->assignee_id = $request->assignee;
        $task->type = $request->type;

        if ($task->save()) {
            return redirect()->route('task.index')->with('message', 'you have successfully updated the task');
        }else{
            return redirect()->route('task.index')->with('message', 'sorry, you have unsuccessfully updated the task');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task->delete()) {
            return redirect()->route('task.index')->with('message', 'you have successfully deleted the task');
        }else{
            return redirect()->route('task.index')->with('message', 'sorry, you have unsuccessfully deleted the task');
        }
    }
}
