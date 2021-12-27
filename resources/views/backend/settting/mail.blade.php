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
        <form method="POST" action="{{ route('app.setting.mail.update') }}">
            @csrf
            @method('PUT')
            <div class="main-card mb-3 card" style="padding: 20px;">
                <div class="cart-body">

                    <div class="form-row">
                        <div class="col">
                        <div class="from-group mb-3">
                        <lebel for="mail_mailer">Mail Mailer</lebel>
                        <input id="mail_mailer" type="text" class="form-control @error('mail_mailer') is-invalid @enderror" name="mail_mailer" value="{{ setting('mail_mailer') ?? old('mail_mailer') }}">
                        @error('mail_mailer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                        </div>
                        <div class="col">
                                <div class="from-group mb-3">
                        <lebel for="mail_encryption">Mail Encryption</lebel>
                        <input id="mail_encryption" type="text" class="form-control @error('mail_encryption') is-invalid @enderror" name="mail_encryption" value="{{ setting('mail_encryption') ?? old('mail_encryption') }}">
                        @error('mail_encryption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                    </div>

                     <div class="form-row">
                        <div class="col">
                        <div class="from-group mb-3">
                        <lebel for="mail_host">Mail Host</lebel>
                        <input id="mail_host" type="text" class="form-control @error('mail_host') is-invalid @enderror" name="mail_host" value="{{ setting('mail_host') ?? old('mail_host') }}">
                        @error('mail_host')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                        </div>
                        <div class="col">
                                <div class="from-group mb-3">
                        <lebel for="mail_port">Mail Port</lebel>
                        <input id="mail_port" type="text" class="form-control @error('mail_port') is-invalid @enderror" name="mail_port" value="{{ setting('mail_port') ?? old('mail_port') }}">
                        @error('mail_port')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                    </div>
                     <div class="from-group mb-3">
                        <lebel for="mail_username">Mail Username</lebel>
                        <input id="mail_username" type="text" class="form-control @error('mail_username') is-invalid @enderror" name="mail_username" value="{{ setting('mail_username') ?? old('mail_username') }}">
                        @error('mail_username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div class="from-group mb-3">
                        <lebel for="mail_password">Mail Password</lebel>
                        <input id="mail_password" type="password" class="form-control @error('mail_password') is-invalid @enderror" name="mail_password" value="{{ setting('mail_password') ?? old('mail_password') }}">
                        @error('mail_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
 
                     <div class="from-group mb-3">
                        <lebel for="mail_from_address">Mail From Address</lebel>
                        <input id="mail_from_address" type="email" class="form-control @error('mail_from_address') is-invalid @enderror" name="mail_from_address" value="{{ setting('mail_from_address') ?? old('mail_from_address') }}">
                        @error('mail_from_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>  

                     <div class="from-group mb-3">
                        <lebel for="mail_from_name">Mail From Name</lebel>
                        <input id="mail_from_name" type="text" class="form-control @error('mail_from_name') is-invalid @enderror" name="mail_from_name" value="{{ setting('mail_from_name') ?? old('mail_from_name') }}">
                        @error('mail_from_name')
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
