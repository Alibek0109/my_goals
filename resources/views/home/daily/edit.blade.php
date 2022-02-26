@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mt-3">Edit Daily Plan</h2>

        @include('inc.error.validate_error')

        <form action="{{ route('home.daily.update', ['id' => $update_id]) }}" method="post">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ $data->title }}" placeholder="Title">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    value="{{ $data->description }}" name="description" placeholder="Description">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning mt-2">Update</button>
        </form>
    </div>
@endsection
