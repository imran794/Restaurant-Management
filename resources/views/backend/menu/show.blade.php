@extends('layouts.backend.app')

@section('title','User Show')


@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>All User</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.users.edit',$user->id) }}" class="btn-shadow mr-3 btn btn-info">
                <i class="fa fa-edit"></i>
                Edit User
            </a>
            <a href="{{ route('app.users.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="main-card card">
            <div class="card-body">
                <img width="150" class="rounded-circle" src="{{ Storage::disk('public')->url('avatar/'.$user->avatar) }}" alt="User Avatar">
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Name:</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Role:</th>
                            <td>
                                @if ($user->role)
                                <span class="badge badge-info">{{ $user->role->name }}</span>
                                @else
                                <span class="badge badge-danger">No role found :(</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Status:</th>
                            <td>
                                @if ($user->status)
                                <div class="badge badge-success">Active</div>
                                @else
                                <div class="badge badge-danger">Inactive</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Joined At:</th>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Modified At:</th>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Login At:</th>
                            <td>{{ $user->last_login_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
