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
            <div>
                @isset($menuitem)
                Edit Menu Item
                @else
                Add New Menu Item To (<code>{{ $menu->name }}</code>)
                @endisset
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.menus.bulider', $menu->id) }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ isset($menuitem) ? route('app.menus.item.update',['id' => $menu->id , 'itemId' =>$menuitem->id ]) : route('app.menus.item.store',$menu->id) }}">
            @csrf
            @isset($menuitem)
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card" style="padding: 20px;">

                        <div class="cart-body">
                            <h5 class="cart-title">Manage Menu Item</h5>
                            <div class="form-group">
                                <lavel for='type'>Type</lavel>
                                <select name="type" id="type" class="custom-select  @error('type') is-invalid @enderror" onchange="setSecectItem()">
                                    <option value="item" @isset($menuitem) {{ $menuitem->type == 'item' ? 'selected' : '' }} @endisset>Menu Item</option>
                                    <option value="divider" @isset($menuitem) {{ $menuitem->type == 'divider' ? 'selected' : '' }} @endisset>Divider</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div id="divider_fields">
                                <div class="from-group mb-3">
                                    <lebel for="divider_title">Title Of The Divider</lebel>
                                    <input id="divider_title" type="text" class="form-control @error('divider_title') is-invalid @enderror" name="divider_title" value="{{ $menuitem->divider_title ?? old('divider_title') }}" autofocus>
                                    @error('divider_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div id="title_fields">
                                <div class="from-group mb-3">
                                    <lebel for="title">Title</lebel>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $menuitem->title ?? old('title') }}" autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="from-group mb-3">
                                    <lebel for="url">URL For The Menu Item</lebel>
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $menuitem->url ?? old('url') }}" autofocus>
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <lavel for='target'>Open In</lavel>
                                    <select name="target" id="target" class="custom-select @error('target') is-invalid @enderror">
                                        <option value="_self" @isset($menuitem) {{ $menuitem->target == '_self' ? 'selected' : '' }} @endisset>Same Tab/Window</option>
                                        <option value="_black" @isset($menuitem) {{ $menuitem->target == '_black' ? 'selected' : '' }} @endisset>New Tab/Window</option>
                                    </select>
                                    @error('target')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="from-group mb-3">
                                    <lebel for="icon_class">Eont Icon Class For Menu Item <a target="_blank" href="https://fontawesome.com/">(Use
                                            a Fontawesome Font Class)</a></lebel>
                                    <input id="icon_class" type="text" class="form-control @error('icon_class') is-invalid @enderror" name="icon_class" value="{{ $menuitem->icon_class ?? old('icon_class') }}" autofocus>
                                    @error('icon_class')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                                @isset($menuitem)
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


@push('js')


<script>
    function setSecectItem() {
        if ($('select[name="type"]').val() === 'divider') {
            $('#divider_fields').removeClass('d-none');
            $('#title_fields').addClass('d-none');
        } else {
            $('#title_fields').removeClass('d-none');
            $('#divider_fields').addClass('d-none');
        }
    }
    setSecectItem();
    $('input[name="type"]').change(setSecectItem);

</script>

@endpush
