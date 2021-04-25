@if ($item->type == 'task')
    <a href="{{route('task.edit', ['task'=>$item->id])}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
        <span class="material-icons-outlined">create</span>
    </a>
    <a href="{{route('task.show', ['task'=>$item->id])}}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Comment">
        <span class="material-icons-outlined">chat_bubble_outline</span>
    </a>
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
