@if (count($comments) > 0)
    <ul class="list-group">
        @foreach ($comments as $item)
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <div class="mb-1 fw-bold">{{!empty($item->user_id) ? $item->user->name : 'unknown'}}</div>
                    <small class="text-muted">{{$item->timer}}</small>
                </div>
                <p class="mb-1">{{$item->content}}</p>
                @if (Auth::user()->id == $item->user_id)
                    <small>
                        <a href="{{route('comment.destroy', ['id'=>$task->id, 'comment'=>$item->id])}}" class="text-danger">
                            <span class="material-icons-outlined">delete</span>
                        </a>
                    </small>
                @endif
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
