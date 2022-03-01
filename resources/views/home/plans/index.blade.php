@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center mt-3 h1"><i class="fa-solid fa-list-check"></i></div>
        <h2 class="text-center mt-3">Plans</h2>
        <h3 class="text-center mt-5">Date: {{ $nowTime }}</h3>


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
                            @if ($el->done == 0)
                                <span class="h3">{{ $el->title }}</span>
                            @elseif ($el->done == 1)
                                <span class="h3"><s>{{ $el->title }}</s></span>
                            @endif
                            <div>{{ $el->description }}</div>
                        </div>
                        <div class="col text-center h3">
                            <form action="{{ route('home.plans.doneChange', ['id' => $el->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="badge alert-success border-0"><i
                                        class="fa-solid fa-check mx-2 text-success"></i></button>
                            </form>
                            <form action="{{ route('home.plans.edit', ['id' => $el->id]) }}" method="get"
                                class="d-inline">
                                <button type="submit" class="badge alert-warning border-0"><i
                                        class="fa-solid  fa-pen mx-2 text-dark"></i></button>
                            </form>
                            <form action="{{ route('home.plans.destroy', ['id' => $el->id]) }}" method="post"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
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
