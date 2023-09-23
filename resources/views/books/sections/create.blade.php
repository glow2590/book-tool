@extends('layouts.app')
@section('content')
@push('styles')

@endpush
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('sections.store',$book) }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="form-control" name="title">
                </div>




                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" cols="30">


                </textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection