@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mt-3">Create Plan</h2>

        @include('inc.error.validate_error')

        <form action="{{ route('home.plans.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Title">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" placeholder="Description">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-2">Create</button>
        </form>
    </div>
@endsection
