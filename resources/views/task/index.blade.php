@extends('layouts.main')

@section('title'){{'Daily Tasks'}}@endsection

@section('pagestyle')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {{-- <form method="GET" action="{{route('task.index')}}"> --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control datepicker" name="month" id="monthInput" placeholder="Filter by Month" value="{{request()->month}}">
                        <button class="btn btn-outline-secondary" type="button" id="filterMonth">Get</button>
                    </div>
                {{-- </form> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
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
    $(".datepicker").datepicker( {
        format: "mm-yyyy",
        startView: "months",
        minViewMode: "months"
    });
    $('#filterMonth').click(function () {
        var param = $('#monthInput').val();
        window.LaravelDataTables.column(0)
        .search( param )
        .draw();
    });
})
</script>
@endsection
