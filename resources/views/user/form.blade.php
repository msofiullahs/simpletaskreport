@extends('layouts.main')

@section('title'){{'Users'}}@endsection

@section('pagestyle')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ isset($user) ? route('user.update', ['user'=>$user->id]) : route('user.store') }}">
                    @csrf
                    @isset($task)
                        @method('PUT')
                    @endisset
                    <div class="row align-items-center mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="{{ isset($user) ? $user->name : old('name') }}" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" name="email" class="form-control" value="{{ isset($user) ? $user->email : old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="role" id="role">
                                <option value="assignee" {{(isset($user) && $user->role == 'assignee') || old('role') == 'assignee' ? 'selected=selected' : ''}}>Assignee</option>
                                <option value="reporter" {{(isset($user) && $user->role == 'reporter') || old('role') == 'reporter' ? 'selected=selected' : ''}}>Reporter</option>
                                <option value="superadmin" {{(isset($user) && $user->role == 'superadmin') || old('role') == 'superadmin' ? 'selected=selected' : ''}}>Superadmin</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="send_email">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Send email?
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                    <a href="{{route('user.index')}}" class="btn btn-outline-secondary">Cancel</a>
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
