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
            <div>{{ isset($slider) ? 'Edit Slider' : 'Create Slider' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.roles.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="main-card mb-3 card" style="padding: 20px;">
            <form method="POST" action="{{ isset($slider) ? route('app.sliders.update',$slider->id) : route('app.sliders.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($slider)
                @method('PUT')
                @endisset
                <div class="cart-body">
                  <h5 class="cart-title">Slider Create</h5>
                </div>
                <div class="from-group mb-3">
                      <lebel for="title">Slider Title</lebel>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $slider->title ?? old('title') }}" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                 <div class="from-group mb-3">
                       <lebel for="title">Slider Sub Title</lebel>
                    <input id="sub_title" type="text" class="form-control @error('sub_title') is-invalid @enderror" name="sub_title" value="{{ $slider->sub_title ?? old('sub_title') }}" autofocus>

                    @error('sub_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                 <div class="from-group mb-3">
                                <lebel for="image">Image</lebel>
                                <input id="image" type="file" class="dropify form-control @error('image') is-invalid @enderror" name="image" data-default-file="{{ isset($slider) ? Storage::disk('public')->url('slider/'.$slider->image) : '' }}">
                                @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
        
    
                <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                    @isset($slider)
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
