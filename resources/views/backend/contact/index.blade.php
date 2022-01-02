@extends('layouts.backend.app')

@section('title','Cantact')

@push('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cantact icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Cantact</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card" style="padding: 20px;">
            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Send At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $key=>$contact)
                        <tr>
                            <td class="text-center text-muted">#{{ $key +1 }}</td>
                            <td class="text-center">{{ $contact->name }}</td>
                            <td class="text-center">{{ $contact->email }}</td>
                            <td class="text-center">{{ Str::limit($contact->subject,10) }}</td>
                            <td class="text-center">{{ Str::limit($contact->message,10) }}</td>
                            <td class="text-center">{{ $contact->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                              <a href="{{ route('app.contact.details',$contact->id) }}" class="btn btn-primary btn-sm"> <i class="fas fa-show"></i> Details</a>
                                <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteat({{ $contact->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <form id="delete-form-{{ $contact->id }}" action="{{ route('app.contact.destroy',$contact->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
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
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });

</script>
@endpush
