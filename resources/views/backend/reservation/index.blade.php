@extends('layouts.app')

@section('title', 'All Reservations | Admin')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="content vh-100">
        <div class="row">
            <div class="col-md-12">

                @include('layouts.partials.message')

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">All Category List</h4>
{{--                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-round">Add a Category</a>--}}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="sliderdatatable" style="width:100%">
                            <thead class="text-primary">
                            <th>No.</th>
                            <th>Guest Name</th>
                            <th>Guest Email</th>
                            <th>Guest Phone</th>
                            <th>Guest Message</th>
                            <th>Number of Guest</th>
                            <th>Reservation Date</th>
                            <th>Confirm Status</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($reservations as $key => $reservation)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $reservation->name }}
                                        </td>
                                        <td>
                                            {{ $reservation->email }}
                                        </td>
                                        <td>
                                            {{ $reservation->phone }}
                                        </td>
                                        <td>
                                            {{ $reservation->message }}
                                        </td>
                                        <td>
                                            {{ $reservation->person }}
                                        </td>
                                        <td>
                                            {{ $reservation->date }}
                                        </td>
                                        <td>
                                            @if($reservation->status == true)
                                                <span class="text-success">Confirm</span>
                                            @else
                                                <span class="text-danger">Not Confirmed yet</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#delete-id-{{ $reservation->id }}" class="btn btn-success btn-sm" data-toggle="modal">
                                                Confirm
                                            </a>

                                            <div class="modal fade mt-5" id="delete-id-{{ $reservation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Reservation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to Confirm this reservation?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('reservation.status', $reservation->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Yes</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sliderdatatable').DataTable();
        } );
    </script>
@endpush
