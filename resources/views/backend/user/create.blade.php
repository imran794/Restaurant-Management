@extends('layouts.backend.app')

@section('title','Users')

@push('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
<style>
    .dropify-wrapper .dropify-message p {
        font-size: initial;
    }

</style>
@endpush

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($user) ? 'Edit User' : 'Create User' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.users.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ isset($user) ? route('app.users.update',$user->id) : route('app.users.store') }}" enctype="multipart/form-data">
            @csrf
            @isset($user)
            @method('PUT')
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <div class="cart-body">
                            <h5 class="cart-title">User Info</h5>
                            <div class="from-group mb-3">
                                <lebel for="name">Name</lebel>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="email">Email</lebel>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="password">Password</lebel>
                                <input id="password" type="password" class="form-control @error('name') is-invalid @enderror" name="password" {{ !isset($user) ? 'required' : '' }}>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="password">Confirm Password</lebel>
                                <input id="password" type="password" class="form-control @error('name') is-invalid @enderror" name="password_Confirmation" {{ !isset($user) ? 'required' : '' }}>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <div class="cart-body">
                            <h5 class="cart-title">Select Role And Status</h5>
                            <div class="from-group mb-3">
                                <lebel for="role">Selete Role</lebel>
                                <select id="role" class="js-example-basic-single form-control" name="role">
                                    <option value="">Select One</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @isset($user) {{ $user->role->id == $role->id ? 'selected' : '' }}@endisset>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="avatar">Avatar</lebel>
                                <input id="avatar" type="file" class="dropify form-control @error('avatar') is-invalid @enderror" name="avatar" data-default-file="{{ isset($user) ? Storage::disk('public')->url('avatar/'.$user->avatar) : '' }}" {{ !isset($user) ? 'required' : '' }}>
                                @error('avatar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" name="status" type="checkbox" id="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                                @isset($user)
                                Update
                                @else
                                Create
                                @endisset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    @endsection

    @push('js')

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });

    </script>

    @endpush
