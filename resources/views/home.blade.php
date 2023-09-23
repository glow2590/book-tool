@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row justify-content-around">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif


                        <br>
                        {{-- create a bootstrap card --}}
                        @if (auth()->user()->books->count() > 0)

                        @foreach ( auth()->user()->books as $book )
                        <div class="card col-5">
                            <img class="card-img-top" src="{{ $book->image }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>

                                <p class="card-text">{{substr($book->overview, 0, 50) . '...'

                                    }}</p>
                                <a href="{{ route('books.show',$book->id) }}" class="btn btn-primary">Read The Book</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection