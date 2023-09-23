@extends('layouts.app')
@section('content')
@push('styles')

@endpush
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('collaborators.store',$book) }}">
                @csrf
                <div class="form-group">
                    <label for="email">Collaborator Email:</label>
                    <input type="email" id="email" class="form-control" name="email">
                </div>


        </div>
        <button type="submit" class="btn btn-success btn-sm">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection