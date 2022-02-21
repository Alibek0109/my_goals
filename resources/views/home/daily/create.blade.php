@extends('layouts.app')

@section('content')
    <h2 class="text-center mt-3">Create Daily Plan</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
