@extends('layouts.app')

@section('title')
    Create Slider | Admin
@endsection

@push('css')

@endpush

@section('content')
    <div class="content vh-100">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        @foreach ($errors->all() as $error)
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add a new Slider</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Slider Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Give a slider title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Slider Sub Title</label>
                                        <input type="text" class="form-control" name="sub_title" placeholder="Give a slider sub title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Slider Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-round">Create Slider</button>
                                <a rel="stylesheet" class="btn btn-danger btn-round" href="{{ route('slider.index') }}">Cancel</a>
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
