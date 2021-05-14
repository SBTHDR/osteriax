@extends('layouts.app')

@section('title')
Slider | Admin
@endsection

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
                        <h4 class="card-title">Slider Images List</h4>
                        <a href="{{ route('slider.create') }}" class="btn btn-primary btn-round">Add a Slider</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="sliderdatatable" style="width:100%">
                            <thead class="text-primary">
                            <th>No.</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Images</th>
                            <th>Uploaded Time</th>
                            <th>Modified Time</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($sliders as $key => $slider)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $slider->title }}
                                        </td>
                                        <td>
                                            {{ $slider->sub_title }}
                                        </td>
                                        <td>
                                            {{ $slider->image }}
                                        </td>
                                        <td>
                                            {{ $slider->created_at }}
                                        </td>
                                        <td>
                                            {{ $slider->updated_at }}
                                        </td>
                                        <td>
                                            <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary btn-round btn-sm">Edit</a>
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
