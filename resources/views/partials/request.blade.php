@if ($item->status == 'waiting' && Auth::user()->id == $item->reporter_id)
    <a href="{{route('taskrequest.edit', ['taskrequest'=>$item->id])}}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
        <span class="material-icons-outlined">create</span>
    </a>
    <a href="{{route('taskrequest.destroy', ['taskrequest'=>$item->id])}}" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
        <span class="material-icons-outlined">delete</span>
    </a>
    {{-- <a href="{{route('taskrequest.take', ['taskrequest'=>$item->id])}}" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Take">
        <span class="material-icons-outlined">pan_tool</span>
    </a> --}}
@endif
<a href="{{route('taskrequest.show', ['taskrequest'=>$item->id])}}" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View Detail">
    <span class="material-icons-outlined">visibility</span>
</a>
