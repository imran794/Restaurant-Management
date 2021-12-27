@extends('layouts.backend.app')

@section('title','Create')

@push('css')

@endpush

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($role) ? 'Edit Role' : 'Create Role' }}</div>
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
    <div class="col-md-12">
        <div class="main-card mb-3 card" style="padding: 20px;">
            <form method="POST" action="{{ isset($role) ? route('app.roles.update',$role->id) : route('app.roles.store') }}">
                @csrf
                @isset($role)
                @method('PUT')
                @endisset
                <div class="cart-body">
                    <h5 class="cart-title">Manage Roles</h5>
                </div>
                <div class="from-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="text-center" style="padding-top: 20px;">
                    <strong>Manage Permission For Role</strong>
                    @error('permission')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="from-group" style="padding-bottom:20px;">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="select-all">
                        <label class="custom-control-label" for="select-all">Select All</label>
                    </div>
                </div>
                
                @forelse($modules->chunk(2) as $key=>$chunks)
                <div class="form-row">
                    @foreach($chunks as $key=>$module)
                    <div class="col">
                        <h5>Module: {{ $module->name }}</h5>
                        @foreach ($module->permissions as $key=>$permission)
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-checkbox" id="permission-{{ $permission->id }}" name="permission[]" value="{{ $permission->id }}" @isset($role) @foreach ($role->permissions as $rpermission)
                            {{ $permission->id == $rpermission->id ? 'checked' : ''  }}
                            @endforeach
                            @endisset
                            >
                            <label class="custom-control-checkbox" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>

                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @empty
                <div class="row">
                    <div class="col text-center">
                        <strong>No Module Found</strong>
                    </div>
                </div>
                @endforelse
                <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                    @isset($role)
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

<script>
    $('#select-all').click(function(event) {
        if (this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    })

</script>

@endpush
