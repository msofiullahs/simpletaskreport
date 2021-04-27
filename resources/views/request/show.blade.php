@extends('layouts.main')

@section('title'){{'Task Request'}}@endsection

@section('pagestyle')

@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <div class="row align-items-center mb-3">
                    <div class="col-sm-2 fw-bold">Title</div>
                    <div class="col-sm-10">{{ $task->title }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2 fw-bold">Detail</div>
                    <div class="col-sm-10">{{ $task->detail }}</div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-sm-2 fw-bold">Reporter</div>
                    <div class="col-sm-10">{{ !empty($task->reporter_id) ? $task->reporter->name : '' }}</div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-sm-2 fw-bold">Assignee</div>
                    <div class="col-sm-10">{{ !empty($task->assignee_id) ? $task->assignee->name : '' }}</div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-sm-2 fw-bold">Priority</div>
                    <div class="col-sm-10">{{ Str::title($task->priority) }}</div>
                </div>

            </div>
            <div class="card-footer">
                @if ($task->status == 'waiting' && Auth::user()->id == $task->assignee_id)
                    <a href="{{route('taskrequest.take', ['taskrequest'=>$task->id])}}" class="btn btn-outline-success btn-sm">
                        Take this request
                    </a>
                @endif
                <a href="{{route('taskrequest.index')}}" class="btn btn-outline-secondary btn-sm">
                    Back to list
                </a>
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
