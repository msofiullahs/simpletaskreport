@extends('layouts.main')

@section('title'){{'Request Task'}}@endsection

@section('pagestyle')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ isset($task) ? route('taskrequest.update', ['taskrequest'=>$task->id]) : route('taskrequest.store') }}">
                    @csrf
                    @isset($task)
                        @method('PUT')
                    @endisset
                    <div class="row align-items-center mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" id="title" name="title" class="form-control" value="{{ isset($task) ? $task->title : old('title') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="detail" class="col-sm-2 col-form-label">Detail</label>
                        <div class="col-sm-10">
                            <textarea id="detail" name="detail" class="form-control" required>{{ isset($task) ? $task->detail : old('detail') }}</textarea>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="assignee" class="col-sm-2 col-form-label">Assigned To</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="assignee" id="assignee" data-placeholder="choose assignee" required>
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{(isset($task) && $task->assignee_id == $user->id) || old('assignee') == $user->id ? 'selected=selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="priority" class="col-sm-2 col-form-label">Priority</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="priority" id="priority">
                                <option value="low" {{(isset($task) && $task->priority == 'low') || old('priority') == 'low' ? 'selected=selected' : ''}}>Low</option>
                                <option value="mid" {{(isset($task) && $task->priority == 'mid') || old('priority') == 'mid' ? 'selected=selected' : ''}}>Mid</option>
                                <option value="high" {{(isset($task) && $task->priority == 'high') || old('priority') == 'high' ? 'selected=selected' : ''}}>High</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                    <a href="{{route('taskrequest.index')}}" class="btn btn-outline-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
