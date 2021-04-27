@extends('layouts.main')

@section('title'){{'Daily Tasks'}}@endsection

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
                    <div class="col-sm-2 fw-bold">Hours</div>
                    <div class="col-sm-10">{{ $task->hours }}</div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-sm-2 fw-bold">Date</div>
                    <div class="col-sm-10">{{ $task->reported_at }}</div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-sm-2 fw-bold">Type</div>
                    <div class="col-sm-10">{{ Str::title($task->type) }}</div>
                </div>

            </div>
            <div class="card-footer">
                @if ($task->type == 'task')
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#commentBox" aria-expanded="false" aria-controls="commentBox">
                        Show Comments
                    </button>
                @endif
                <a href="{{route('task.index')}}" class="btn btn-outline-secondary">Back to list</a>
            </div>
        </div>
        @if ($task->type == 'task')
            <div class="collapse mt-3" id="commentBox">
                @if (count($task->comments) > 0)
                    <ul class="list-group">
                        @foreach ($task->comments as $item)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mb-1 fw-bold">{{!empty($item->user_id) ? $item->user->name : 'unknown'}}</div>
                                    <small class="text-muted">{{$item->timer}}</small>
                                </div>
                                <p class="mb-1">{{$item->content}}</p>
                                <small>
                                    <a href="{{route('comment.destroy', ['id'=>$task->id, 'comment'=>$item->id])}}" class="text-danger">
                                        <span class="material-icons-outlined">delete</span>
                                    </a>
                                </small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-muted text-center">No available comments</h3>
                        </div>
                    </div>
                @endif
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" action="{{route('comment.store', ['id'=>$task->id])}}">
                            @csrf
                            <textarea class="form-control mb-3" name="content" placeholder="add comment">{{old('content')}}</textarea>
                            <button class="btn btn-outline-success btn-sm" type="submit">Send Comment</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
