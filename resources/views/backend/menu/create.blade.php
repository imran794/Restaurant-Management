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
                <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($menu) ? 'Edit page' : 'Create Page' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.menus.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ isset($menu) ? route('app.menus.update',$menu->id) : route('app.menus.store') }}" enctype="multipart/form-data">
            @csrf
            @isset($menu)
            @method('PUT')
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card" style="padding: 20px;">

                        <div class="cart-body">
                            <h5 class="cart-title"> BASIC INFO</h5>

                            <div class="from-group mb-3">
                                <lebel for="name">Name</lebel>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $menu->name ?? old('name') }}" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="description"> DESCRIPTION</lebel>
                                <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description"> {{ $menu->description ?? old('description') }}</textarea>

                            </div>
                            <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                                @isset($menu)
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
</div>

@endsection
