@extends('layouts.backend.app')

@section('title','Page Index')

@push('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>All Page</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.pages.create') }}" class="btn-shadow mr-3 btn btn-info">
                <i class="fa fa-plus-circle"></i>
                Create page
            </a>
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
                            <th class="text-center">Title</th>
                            <th class="text-center">Url</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Last Modified</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $key=>$page)
                        <tr>
                            <td class=" text-muted">#{{ $key + 1 }}</td>
                            <td class="text-center">{{ $page->title }}</td>
                            <td class="text-center">
                                <a href="{{ route('page',$page->slug) }}" title="">{{ $page->slug }}</a>
                            </td>
                            <td class="text-center">
                                @if ($page->status == true)
                                <div class="badge badge-success">Active</div>
                                @else
                                <div class="badge badge-danger">Inactive</div>
                                @endif
                            </td>
                            <td class="text-center">{{ $page->created_at->diffForHumans() }}</td>
                            <td class="text-center">

                                <a href="{{ route('app.pages.edit',$page->id) }}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> Edit</a>
                                <a href="{{ route('app.pages.show',$page->id) }}" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i> Show</a>

                                <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteat({{ $page->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <form id="delete-form-{{ $page->id }}" action="{{ route('app.pages.destroy',$page->id) }}" method="POST" style="display: none;">
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
