@if ($item->type == 'task')
    @if (Auth::user()->id == $item->assignee_id)
        <a href="{{route('task.edit', ['task'=>$item->id])}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
            <span class="material-icons-outlined">create</span>
        </a>
    @endif
    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#showComment" data-bs-url="{{route('comment.show', ['id'=>$item->id])}}">
        <span class="material-icons-outlined">chat_bubble_outline</span>
    </button>
@endif
@if ($item->type != 'weekend')
    <a href="{{route('task.show', ['task'=>$item->id])}}" class="btn btn-outline-{{$item->type == 'task' ? 'secondary' : 'light'}} btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View Detail">
        <span class="material-icons-outlined">visibility</span>
    </a>
@else
    <button type="button" disabled class="btn btn-outline-light btn-sm">
        <span class="material-icons-outlined">visibility</span>
    </a>
@endif
