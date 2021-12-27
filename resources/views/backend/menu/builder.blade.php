@extends('layouts.backend.app')

@section('title','Create Menus')

@push('css')
<link rel="stylesheet" href="{{ asset('css/jquery.nestable.min.css') }}">
<style>
    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: inherit;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }

    .dd .item_actions {
        z-index: 9;
        position: relative;
        top: 10px;
        right: 10px;
    }

    .dd .item_actions .edit {
        margin-right: 5px;
    }

    .dd-handle {
        display: block;
        height: 50px;
        margin: 5px 0;
        padding: 14px 25px;
        color: #333;
        text-decoration: none;
        font-weight: 700;
        border: 1px solid #ccc;
        background: #fafafa;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
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
            <div>Menu Bulider ({{ $menu->name }})</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.menus.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>
            <a href="{{ route('app.menus.item.create',$menu->id) }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create New Menu
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
                <div class="col-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">How To Use:</h5>
                            <p>You Can output a manu anywhere on your site by calling <code>menu('name')</code> </p>
                        </div>
                    </div>

                    <div class="main-card mb-3 card" style="padding: 20px;">
                        <h5 class="card-title">Drag and drop the menu Items below to re-arrange them.</h5>
                        <div class="dd">
                            <ol class="dd-list">
                                @forelse($menu->MenuItems as $MenuItem)
                                <li class="dd-item" data-id="{{ $MenuItem->id }}">

                                    <div class="pull-right item_actions">

                                        <a href="{{ route('app.menus.item.edit',['id' => $menu->id , 'itemId' =>$MenuItem->id ]) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                        <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteat({{ $MenuItem->id }})">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                        <form id="delete-form-{{ $MenuItem->id }}" action="{{ route('app.menus.item.destroy',['id' => $menu->id , 'itemId' =>$MenuItem->id ]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>


                                    <div class="dd-handle">
                                        @if ($MenuItem->type == 'item')
                                        <span>{{ $MenuItem->title }}</span>
                                        <small class="url">{{ $MenuItem->url }}</small>
                                        @else
                                        <span>Divider: {{ $MenuItem->divider_title }}</span>
                                        @endif
                                    </div>
                                    @if (!$MenuItem->childe->isEmpty())
                                    <ol class="dd-list">
                                        @forelse($MenuItem->childe as $Itemchilde)
                                        <li class="dd-item" data-id="{{ $Itemchilde->id }}">

                                            <div class="pull-right item_actions">

                                                <a href="{{ route('app.menus.item.edit',['id' => $menu->id , 'itemId' =>$Itemchilde->id ]) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                                <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteat({{ $Itemchilde->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                                <form id="delete-form-{{ $Itemchilde->id }}" action="{{ route('app.menus.item.destroy',['id' => $menu->id , 'itemId' =>$Itemchilde->id ]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                            <div class="dd-handle">
                                                @if ($Itemchilde->type == 'item')
                                                <span>{{ $Itemchilde->title }}</span>
                                                <small class="url">{{ $Itemchilde->url }}</small>
                                                @else
                                                <span>Divider: {{ $Itemchilde->divider_title }}</span>
                                                @endif
                                            </div>
                                        </li>
                                        @empty
                                        <div class="text-center">
                                            <stoang> NO Menu Item Found</stoang>
                                        </div>
                                        @endforelse
                                    </ol>
                                    @endif
                                </li>
                                @empty
                                <div class="text-center">
                                    <stoang> NO Menu Item Found</stoang>
                                </div>
                                @endforelse
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>



@endsection


@push('js')
<script src="{{ asset('js/jquery.nestable.min.js') }}"></script>
<script>
    $('.dd').nestable({
        MaxDepth: 2
    });

</script>
<script>
    $('.dd').on('change', function(e) {
        console.log(JSON.stringify($('.dd').nestable('serialize')));
        $.post('{{ route('app.menus.order',$menu->id) }}', {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            },
            function(data) {
                iziToast.success({
                    title: 'Success',
                    message: 'Successfully updated menu order.',
                });
            });
    });

</script>
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
    function deleteat(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }

</script>

@endpush
