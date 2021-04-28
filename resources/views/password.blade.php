@extends('layouts.main')

@section('title'){{'Change Password'}}@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('updatepass')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="oldPassword">Current Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="old_password" id="oldPassword" placeholder="Your current password" >
                                <button class="btn btn-outline-secondary" type="button" onclick="oldPass()">
                                    <span class="material-icons-outlined" id="btnOld">visibility_off</span>
                                </button>
                            </div>
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Your current password" >
                                <button class="btn btn-outline-secondary" type="button" onclick="newPass()">
                                    <span class="material-icons-outlined" id="btnNew">visibility_off</span>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function oldPass() {
    var x = document.getElementById("oldPassword");
    var y = document.getElementById("btnOld");
    if (x.type === "password") {
        x.type = "text";
        y.innerText = "visibility";
    } else {
        x.type = "password";
        y.innerText = "visibility_off";
    }
}
function newPass() {
    var x = document.getElementById("password");
    var y = document.getElementById("btnNew");
    if (x.type === "password") {
        x.type = "text";
        x.innerText = "visibility";
    } else {
        x.type = "password";
        y.innerText = "visibility_off";
    }
}
</script>
@endsection
