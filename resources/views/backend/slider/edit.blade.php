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

                @include('layouts.partials.message')

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add a new Slider</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Slider Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Give a slider title" value="{{ $slider->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Slider Sub Title</label>
                                        <input type="text" class="form-control" name="sub_title" placeholder="Give a slider sub title" value="{{ $slider->sub_title }}">
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
                                <button type="submit" class="btn btn-primary btn-round">Update Slider</button>
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
