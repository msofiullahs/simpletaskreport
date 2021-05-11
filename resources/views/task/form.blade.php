@extends('layouts.main')

@section('title'){{'Daily Tasks'}}@endsection

@section('pagestyle')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ isset($task) ? route('task.update', ['task'=>$task->id]) : route('task.store') }}">
                    @csrf
                    @isset($task)
                        @method('PUT')
                    @endisset
                    <div class="row align-items-center mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" id="title" name="title" class="form-control" value="{{ isset($task) ? $task->title : old('title') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="detail" class="col-sm-2 col-form-label">Detail</label>
                        <div class="col-sm-10">
                            <textarea id="detail" name="detail" class="form-control">{{ isset($task) ? $task->detail : old('detail') }}</textarea>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="reporter" class="col-sm-2 col-form-label">Reporter</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="reporter" id="reporter" data-placeholder="Choose reporter">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{(isset($task) && $task->reporter_id == $user->id) || old('reporter') == $user->id ? 'selected="selected"' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="assignee" class="col-sm-2 col-form-label">Assignee</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="assignee" id="assignee" data-placeholder="Choose assignee">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{(isset($task) && $task->assignee_id == $user->id) || old('assignee') == $user->id ? 'selected="selected"' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="hours" class="col-sm-2 col-form-label">Hours</label>
                        <div class="col-sm-10">
                            <input type="number" id="hours" name="hours" class="form-control" value="{{ isset($task) ? $task->hours : old('hours') }}">
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="reported_at" class="col-sm-2 col-form-label">Reported Date</label>
                        <div class="col-sm-10">
                            <input type="text" id="reported_at" name="reported_at" class="form-control datepicker" value="{{ isset($task) ? $task->reported_at : old('reported_at') }}">
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="priority" class="col-sm-2 col-form-label">Priority</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="priority" id="priority">
                                <option value="low" {{(isset($task) && $task->priority == 'low') || old('priority') == 'low' ? 'selected="selected"' : ''}}>Low</option>
                                <option value="mid" {{(isset($task) && $task->priority == 'mid') || old('priority') == 'mid' ? 'selected="selected"' : ''}}>Mid</option>
                                <option value="high" {{(isset($task) && $task->priority == 'high') || old('priority') == 'high' ? 'selected="selected"' : ''}}>High</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="type" id="type">
                                <option value="task" {{(isset($task) && $task->type == 'task') || old('type') == 'task' ? 'selected="selected"' : ''}}>Task</option>
                                <option value="weekend" {{(isset($task) && $task->type == 'weekend') || old('type') == 'weekend' ? 'selected="selected"' : ''}}>Weekend</option>
                                <option value="offday" {{(isset($task) && $task->type == 'offday') || old('type') == 'offday' ? 'selected="selected"' : ''}}>Off Day</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                    <a href="{{route('task.index')}}" class="btn btn-outline-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
    $('.datepicker').datepicker({
        clearBtn: true,
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
    });
});
</script>
@endsection
