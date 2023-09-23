@extends('layouts.app')
@section('content')
@push('styles')

@endpush
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('sections.update',['book'=>$book,'section'=>$section->id]) }}">

                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ $section->title }}">
                </div>



                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" cols="30">
                        {!! $section->content !!}

                </textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm">update</button>
            </form>
        </div>
    </div>
</div>
@endsection