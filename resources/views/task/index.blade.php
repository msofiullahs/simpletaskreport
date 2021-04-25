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
@endsection

@section('script')
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{$dataTable->scripts()}}
<script type="text/javascript">
$(document).ready(function () {
    $("#{{$dataTable->getTableAttribute('id')}}").on('draw.dt', function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
})
</script>
@endsection
