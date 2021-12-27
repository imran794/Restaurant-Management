@extends('layouts.backend.app')

@section('title','Create Menus')

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
                <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Apearance Setting</div>
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
        <form method="POST" action="{{ route('app.setting.apearance.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="main-card mb-3 card" style="padding: 20px;">
                <div class="cart-body">
                    <div class="form-group">
                        <label for="site_logo">Logo (Only Image are allowed) <code>{ key: site_logo }</code></label>
                        <input type="file" name="site_logo" id="site_logo" class="dropify @error('site_logo') is-invalid @enderror" data-default-file="{{ setting('site_logo') != null ?  Storage::url(setting('site_logo')) : '' }}">
                        @error('site_logo')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="site_favicon">Favicon (Only Image are allowed, Size: 33 X 33) <code>{ key: site_favicon }</code></label>
                        <input type="file" name="site_favicon" id="site_favicon" class="dropify @error('site_favicon') is-invalid @enderror" data-default-file="{{ setting('site_favicon') != null ?  Storage::url(setting('site_favicon')) : '' }}">
                        @error('site_favicon')
                        <span class="text-danger" role="alert">
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


@push('js')

<script src="{{ asset('js/dropify.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });

</script>

@endpush
