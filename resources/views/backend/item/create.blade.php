@extends('layouts.app')

@section('title', 'Create Item | Admin')

@push('css')

@endpush

@section('content')
    <div class="content vh-100">
        <div class="row">
            <div class="col-md-12">

                @include('layouts.partials.message')

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add a new Item</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Give a item name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item Description</label>
                                        <textarea class="form-control" name="description" cols="30" rows="10" placeholder="Give a item description"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item Price</label>
                                        <input type="number" class="form-control" name="price" placeholder="Give a item price">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Item Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-round">Create Item</button>
                                <a rel="stylesheet" class="btn btn-danger btn-round" href="{{ route('item.index') }}">Cancel</a>
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
