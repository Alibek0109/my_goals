@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center mt-3 h1"><i class="fa-solid fa-trash-can"></i></div>

        <h2 class="text-center mt-3">Plans Bin</h2>

        {{-- <div class="panel mt-3 mb-3">
            <div class="row justify-content-around">
                <div class="col-md-4 d-flex justify-content-center">
                    <form action="{{ route('home.plans.recycle_bin_restore_all') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore all</button>
                    </form>
                </div>

                <div class="col-md-4 d-flex justify-content-center">
                    <form action="{{ route('home.plans.recycle_bin_destroy_all') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Clear</button>
                    </form>
                </div>
            </div>
        </div> --}}

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <ul class="list-group mt-3">
            @foreach ($data as $el)
                <li class="list-group-item alert">
                    <div class="row">
                        <div class="col-10">
                            <div class="h5">{{$el->created_at->isoFormat("DD MMMM")}}</div>
                            <span class="h3">{{ $el->title }}</span>
                            <div>{{ $el->description }}</div>
                        </div>
                        <div class="col text-center h3">
                            <form action="{{ route('home.plans.recycle_bin_restore', ['id' => $el->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="badge alert-success border-0"><i
                                        class="fa-solid fa-recycle mx-2 text-success"></i></button>
                            </form>
                            <form action="{{ route('home.plans.recycle_bin_destroy', ['id' => $el->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="badge alert-danger border-0"><i
                                        class="fa-solid fa-xmark mx-2 text-danger"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
