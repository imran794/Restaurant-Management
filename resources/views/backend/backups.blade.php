@extends('layouts.backend.app')

@section('title','Backups')

@push('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Backups</div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="event.preventDefault();
                   document.getElementById('old-backup-delete').submit();" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-trash"></i>
                Old Backup Delete
            </button>
            <form id="old-backup-delete" action="{{ route('app.backups.deleted') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" onclick="event.preventDefault();
                   document.getElementById('new-backup-create').submit();" class="btn-shadow mr-3 btn btn-info">
                <i class="fa fa-plus-circle"></i>
                Create New Backup
            </button>
            <form id="new-backup-create" action="{{ route('app.backups.store') }}" method="POST" style="display: none;">
                @csrf
            </form>
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
                            <th>File Name</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($backups as $key=>$backup)
                        <tr>
                            <td class="text-center text-muted">#{{ $key +1 }}</td>

                            <td class=""> <code>{{ $backup['file_name'] }}</code></td>
                            <td class="">{{ $backup['file_size'] }}</td>
                            <td class="">{{ $backup['created_at'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('app.backup.download',$backup['file_name']) }}" class="btn btn-primary btn-sm"> <i class="fas fa-download"></i> Download</a>
                                <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteat({{ $key }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <form id="delete-form-{{ $key }}" action="{{ route('app.backups.destroy',$backup['file_name']) }}" method="POST" style="display: none;">
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
