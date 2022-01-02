@extends('layouts.backend.app')

@section('title','Contact Show')

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
             
            <div>All Contact Message</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.contact.show') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back To List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="main-card mb-3 card" style="padding: 20px;">
                <div class="cart-body">
                  <h5 class="crt-title">All Contact Message</h5>
                </div>
                <div class="from-group mb-3">
                      <lebel for="title">Name</lebel>
                    <input id="name" type="text" class="form-control" value="{{ $contact->name }}">
                </div>
                <div class="from-group mb-3">
                      <lebel for="title">Email</lebel>
                    <input id="name" type="text" class="form-control" value="{{ $contact->email }}">
                </div>
                <div class="from-group mb-3">
                      <lebel for="title">Subject</lebel>
                    <input id="name" type="text" class="form-control" value="{{ $contact->subject }}">
                </div>
                <div class="from-group mb-3">
                      <lebel for="title">Subject</lebel>
                       <textarea name="message" type="text" class="form-control" id="message" rows="10" required="required" placeholder="  Message">{{ $contact->message }}</textarea>
                </div>
        </div>
    </div>
     
</div>


@endsection

@push('js')


@endpush
