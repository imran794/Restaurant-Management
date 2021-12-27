@extends('layouts.backend.app')

@section('title','Create Pages')

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
                <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($page) ? 'Edit page' : 'Create Page' }}</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.pages.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ isset($page) ? route('app.pages.update',$page->id) : route('app.pages.store') }}" enctype="multipart/form-data">
            @csrf
            @isset($page)
            @method('PUT')
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <div class="cart-body">
                            <h5 class="cart-title"> BASIC INFO</h5>
                            <div class="from-group mb-3">
                                <lebel for="title">TITLE</lebel>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $page->title ?? old('title') }}" autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="excerpt"> EXCERPT</lebel>
                                <textarea id="excerpt" type="excerpt" class="form-control @error('excerpt') is-invalid @enderror" name="excerpt">{{ $page->excerpt ?? old('excerpt') }}</textarea>
                                @error('excerpt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="from-group mb-3">
                                <lebel for="excerpt">Body</lebel>
                                <textarea id="body" type="body" rows="8" class="form-control @error('body') is-invalid @enderror" name="body">{{ $page->body ?? old('body') }}</textarea>
                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                                @isset($page)
                                Update
                                @else
                                Create
                                @endisset
                            </button>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <div class="cart-body">
                            <h5 class="cart-title">SELECT IMAGE AND STATUS</h5>
                            <div class="from-group mb-3">
                                <lebel for="image">Image</lebel>
                                <input id="image" type="file" class="dropify form-control @error('avatar') is-invalid @enderror" name="image" data-default-file="{{ isset($page) ? Storage::disk('public')->url('page/'.$page->image) : '' }}" {{ !isset($page) ? 'required' : '' }}>
                                @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="from-group mb-3">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" name="status" type="checkbox" id="status" @isset($page) {{ $page->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">STATUS</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <div class="cart-body">
                            <h5 class="cart-title">META INFO</h5>
                            <div class="from-group mb-3">
                                <lebel for="meta_description">META DESCRIPTION</lebel>
                                <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description">{{ $page->meta_description ?? old('meta_description') }}</textarea>
                                @error('meta_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="cart-body">
                            <h5 class="cart-title">META DESCRIPTION</h5>
                            <div class="from-group mb-3">
                                <lebel for="meta_keywords">META KEYWORDS</lebel>
                                <textarea id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords">{{ $page->meta_keywords ?? old('meta_keywords') }}</textarea>
                                @error('meta_keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    @endsection

    @push('js')

    <script src="https://cdn.tiny.cloud/1/t169tjh9l6d2zjymshp8eje4pty05ej3q3yhys8w4gl7ar6i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#body',
            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_advtab: true,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            importcss_append: true,
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });

    </script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });

    </script>

    @endpush
