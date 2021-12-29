@extends('layouts.backend.app')

@section('title','Create')

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
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($category) ? 'Edit Slider' : 'Create Slider' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.category.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="main-card mb-3 card" style="padding: 20px;">
            <form method="POST" action="{{ isset($category) ? route('app.category.update',$category->id) : route('app.category.store') }}">
                @csrf
                @isset($category)
                @method('PUT')
                @endisset
                <div class="cart-body">
                  <h5 class="cart-title">Create Category</h5>
                </div>
                <div class="from-group mb-3">
                      <lebel for="title">Category Name</lebel>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name ?? old('name') }}" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
                <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                    @isset($category)
                    Update
                    @else
                    Create
                    @endisset
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
        });

    </script>

@endpush
