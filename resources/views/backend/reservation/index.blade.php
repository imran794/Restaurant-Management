@extends('layouts.backend.app')

@section('title','Reservation')

@push('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-sliders icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Reservation</div>
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
                            <th class="text-center">Phone</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $key=>$reservation)
                        <tr>
                            <td class="text-center text-muted">#{{ $key +1 }}</td>
                            <td class="text-center">{{ $reservation->name }}</td>
                            <td class="text-center">{{ $reservation->email }}</td>
                            <td class="text-center">{{ $reservation->phone }}</td>
                            <td class="text-center">{{ $reservation->date_and_time }}</td>
                            <td class="text-center">{{ $reservation->message }}</td>

                        
                            <td class="text-center">
                                @if ($reservation->status == false)
                                    <span class="badge badge-danger">Not Confirmed Yet</label>
                                @else
                                    <span class="badge badge-info">Confirmed</label> 
                                @endif
                            </td>
                            <td class="text-center">

                                    @if ($reservation->status == false)
                                      <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="confirm({{ $reservation->id }})">
                                    <i class="fas fa-check"></i> Confirm
                                </button>
                                <form id="confirm-{{ $reservation->id }}" action="{{ route('app.reservation.status',$reservation->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                 </form>

                                    @else
                                        
                                    @endif
                                    


                              
                                <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteat({{ $reservation->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <form id="delete-form-{{ $reservation->id }}" action="{{ route('app.reservation.destroy',$reservation->id) }}" method="POST" style="display: none;">
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
    function confirm(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'are you sure tO Confirm!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('confirm-' + id).submit();
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

<script type="text/javascript">
    function deleteat(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Are You Sure TO Delete!',
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
