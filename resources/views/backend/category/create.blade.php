@extends('layouts.app')

@section('title', 'Create Category | Admin')

@push('css')

@endpush

@section('content')
    <div class="content vh-100">
        <div class="row">
            <div class="col-md-12">

                @include('layouts.partials.message')

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add a new Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Give a category name">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-round">Create Category</button>
                                <a rel="stylesheet" class="btn btn-danger btn-round" href="{{ route('category.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
