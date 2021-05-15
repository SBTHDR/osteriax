@extends('layouts.app')

@section('title', 'All Category | Admin')


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
                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-round">Add a Category</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="sliderdatatable" style="width:100%">
                            <thead class="text-primary">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Uploaded Time</th>
                            <th>Modified Time</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ $category->slug }}
                                        </td>
                                        <td>
                                            {{ $category->created_at }}
                                        </td>
                                        <td>
                                            {{ $category->updated_at }}
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                            <a href="#delete-id-{{ $category->id }}" class="btn btn-danger btn-sm" data-toggle="modal">
                                                Delete
                                            </a>

                                            <div class="modal fade mt-5" id="delete-id-{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Slider</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this Category?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
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
