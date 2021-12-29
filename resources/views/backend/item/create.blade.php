@extends('layouts.backend.app')

@section('title','items')

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
            <div>{{ isset($item) ? 'Edit item' : 'Create item' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.item.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ isset($item) ? route('app.item.update',$item->id) : route('app.item.store') }}" enctype="multipart/form-data">
            @csrf
            @isset($item)
            @method('PUT')
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <div class="cart-body">
                            <h5 class="cart-title">Item Info</h5>
                            <div class="from-group mb-3">
                                <lebel for="name">Item Name</lebel>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name ?? old('name') }}" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="price">Price</lebel>
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $item->price ?? old('price') }}" autofocus>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="description">Description</lebel>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ $item->description ?? old('description') }}</textarea>
                                @error('description')
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
                            <h5 class="cart-title">Select Category  And Image</h5>
                            <div class="from-group mb-3">
                                <lebel for="role">Selete Category</lebel>
                                <select id="role" class="js-example-basic-single form-control" name="category_id">
                                    <option value="">Select One</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @isset($item) {{ $category->id == $item->category->id ? 'selected' : '' }}@endisset>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="image">Image</lebel>
                                <input id="image" type="file" class="dropify form-control @error('image') is-invalid @enderror" name="image" data-default-file="{{ isset($item) ? Storage::disk('public')->url('image/'.$item->image) : '' }}" {{ !isset($item) ? 'required' : '' }}>
                                @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                                @isset($item)
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
