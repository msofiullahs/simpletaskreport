@extends('layouts.main')

@section('title'){{'Daily Tasks'}}@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive table-centered">
                    {{$dataTable->table()}}
                </div>

            </div>
            <div class="card-footer">
                <span class="weekend">Weekend</span>
                <span class="offday">National Off Day</span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="showComment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{$dataTable->scripts()}}
<script type="text/javascript">
$(document).ready(function () {
    $("#{{$dataTable->getTableAttribute('id')}}").on('draw.dt', function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
    $('#showComment').on('show.bs.modal', function(e){
        var button = e.relatedTarget;
        var url = button.getAttribute('data-bs-url');
        $.get(url).done(function(data){
            var body = $('#showComment').find('.modal-body');
            body.html('');
            body.html(data.html);
        })
    });
})
</script>
@endsection
