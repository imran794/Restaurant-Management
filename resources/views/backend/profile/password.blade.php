@extends('layouts.backend.app')

@section('title','Update Password')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-lock icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Profile Security</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card" style="padding: 20px;">
            <form method="POST" action="{{ route('app.password.update') }}">
                @csrf
                <div class="cart-body">
                    <h5 class="cart-title">Update Password</h5>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="from-group mb-3">
                            <lebel for="name">Old Password</lebel>
                            <input type="password" id="old_password" class="form-control" name="old_password">
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="from-group mb-3">
                            <lebel for="name">Enter your new password</lebel>
                            <input type="password" id="password" class="form-control" name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="from-group mb-3">
                            <lebel for="email">Enter your new password again</lebel>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">

                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                    Update
                </button>
            </form>
        </div>
    </div>
</div>


@endsection

