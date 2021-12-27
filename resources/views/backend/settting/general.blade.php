@extends('layouts.backend.app')

@section('title','Create Menus')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>General Setting</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.dashboard') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        @include('backend\settting\sidebar')
    </div>
    <div class="col-md-9">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">How To Use:</h5>
                <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code></p>
            </div>
        </div>
        <form method="POST" action="{{ route('app.setting.general.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="main-card mb-3 card" style="padding: 20px;">
                <div class="cart-body">
                    <div class="from-group mb-3">
                        <lebel for="name">Site Title</lebel>
                        <input id="name" type="text" class="form-control @error('site_title') is-invalid @enderror" name="site_title" value="{{ setting('site_title') ?? old('site_title') }}">
                        @error('site_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="from-group mb-3">
                        <lebel for="description">Site Description</lebel>
                        <textarea id="site_description" class="form-control @error('site_description') is-invalid @enderror" name="site_description"> {{ setting('site_description') ?? old('site_description') }}</textarea>
                        @error('site_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="from-group mb-3">
                        <lebel for="description">Site Address</lebel>
                        <textarea id="site_address" class="form-control @error('site_address') is-invalid @enderror" name="site_address"> {{ setting('site_address') ?? old('site_address') }}</textarea>
                        @error('site_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
