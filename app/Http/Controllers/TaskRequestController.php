<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TaskRequestDataTable;
use App\Models\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskRequestDataTable $dataTable)
    {
        return $dataTable->render('request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('request.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = Auth::user();
        $taskReq = new TaskRequest();
        $taskReq->title = $request->title;
        $taskReq->detail = $request->detail;
        $taskReq->reporter_id = $auth->id;
        $taskReq->assignee_id = $request->assignee;
        $taskReq->priority = $request->priority;
        $taskReq->status = 'waiting';

        if ($taskReq->save()) {
            return redirect()->route('taskrequest.index')->with('message', 'you have successfully added new request');
        }else{
            return redirect()->route('taskrequest.index')->with('message', 'sorry, you have unsuccessfully added new request');
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
        $task = TaskRequest::findOrFail($id);
        return view('request.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = TaskRequest::findOrFail($id);
        $users = User::all();
        return view('request.form', compact('task', 'users'));
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
        $auth = Auth::user();
        $taskReq = TaskRequest::find($id);
        $taskReq->title = $request->title;
        $taskReq->detail = $request->detail;
        $taskReq->reporter_id = $auth->id;
        $taskReq->assignee_id = $request->assignee;
        $taskReq->priority = $request->priority;

        if ($taskReq->save()) {
            return redirect()->route('taskrequest.index')->with('message', 'you have successfully updated new request');
        }else{
            return redirect()->route('taskrequest.index')->with('message', 'sorry, you have unsuccessfully updated new request');
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
        $taskReq = TaskRequest::find($id);
        if ($taskReq->delete()) {
            return redirect()->route('taskrequest.index')->with('message', 'you have successfully deleted the request');
        }else{
            return redirect()->route('taskrequest.index')->with('message', 'sorry, you have unsuccessfully deleted the request');
        }
    }

    public function take($id)
    {
        $taskReq = TaskRequest::find($id);

        $task = new Task();
        $task->reported_at = Carbon::now()->format('Y-m-d');
        $task->title = $taskReq->title;
        $task->detail = $taskReq->detail;
        $task->request_id = $taskReq->id;
        $task->reporter_id = $taskReq->reporter_id;
        $task->assignee_id = $taskReq->assignee_id;
        $task->priority = $taskReq->priority;
        $task->type = 'task';
        $task->save();

        $taskReq->status = 'taken';

        if ($taskReq->save()) {
            return redirect()->route('taskrequest.index')->with('message', 'you had successfully take the task');
        }else{
            return redirect()->route('taskrequest.index')->with('message', 'sorry, you had unsuccessfully take the task');
        }
    }
}
