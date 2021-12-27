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
            <div>Mail Setting</div>
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
        <form method="POST" action="{{ route('app.setting.socialite.update') }}">
            @csrf
            @method('PUT')
            <div class="main-card mb-3 card" style="padding: 20px;">
                <div class="cart-body">
                     <div class="from-group mb-3">
                        <lebel for="githup_client_id">Githup Client Id</lebel>
                        <input id="githup_client_id" type="text" class="form-control @error('githup_client_id') is-invalid @enderror" name="githup_client_id" value="{{ setting('githup_client_id') ?? old('githup_client_id') }}">
                        @error('githup_client_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div class="from-group mb-3">
                        <lebel for="githup_client_secret">Githup Client Secret</lebel>
                        <input id="githup_client_secret" type="password" class="form-control @error('githup_client_secret') is-invalid @enderror" name="githup_client_secret" value="{{ setting('githup_client_secret') ?? old('githup_client_secret') }}">
                        @error('githup_client_secret')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                     <div class="from-group mb-3">
                        <lebel for="google_client_id">Google Client Id</lebel>
                        <input id="google_client_id" type="text" class="form-control @error('google_client_id') is-invalid @enderror" name="google_client_id" value="{{ setting('google_client_id') ?? old('google_client_id') }}">
                        @error('google_client_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div class="from-group mb-3">
                        <lebel for="google_client_secret">Google Client Secret</lebel>
                        <input id="google_client_secret" type="password" class="form-control @error('google_client_secret') is-invalid @enderror" name="google_client_secret" value="{{ setting('google_client_secret') ?? old('google_client_secret') }}">
                        @error('google_client_secret')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>  

                     <div class="from-group mb-3">
                        <lebel for="facebook_client_id">Facebook Client Id</lebel>
                        <input id="facebook_client_id" type="text" class="form-control @error('facebook_client_id') is-invalid @enderror" name="facebook_client_id" value="{{ setting('facebook_client_id') ?? old('facebook_client_id') }}">
                        @error('facebook_client_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div class="from-group mb-3">
                        <lebel for="facebook_client_secret">Facebook Client Secret</lebel>
                        <input id="facebook_client_secret" type="password" class="form-control @error('facebook_client_secret') is-invalid @enderror" name="facebook_client_secret" value="{{ setting('facebook_client_secret') ?? old('facebook_client_secret') }}">
                        @error('facebook_client_secret')
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

