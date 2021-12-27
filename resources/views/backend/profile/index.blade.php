@extends('layouts.backend.app')

@section('title','Profile')

@push('css')
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
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Profile</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card" style="padding: 20px;">
            <form method="POST" action="{{ route('app.profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="cart-body">
                    <h5 class="cart-title">User Profile</h5>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="from-group mb-3">
                            <lebel for="avatar">Avatar</lebel>
                            <input id="avatar" type="file" class="dropify form-control @error('avatar') is-invalid @enderror" name="avatar">
                            <div class="pt-3">
                                <img width="40" class="rounded-circle" src="{{ Storage::disk('public')->url('avatar/'.Auth::user()->avatar) }}" alt="User Avatar">
                            </div>
                            @error('avatar')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="from-group mb-3">
                            <lebel for="name">Name</lebel>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="from-group mb-3">
                            <lebel for="email">Email</lebel>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}">

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

@push('js')

<script src="{{ asset('js/dropify.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        $('.js-example-basic-single').select2();
    });

</script>

@endpush
