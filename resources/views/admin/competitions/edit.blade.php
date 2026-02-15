@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Competition</h2>

    <form action="{{ route('competitionupdate', $competition->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $competition->title }}" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="essay" @if($competition->type=='essay') selected @endif>Essay</option>
                <option value="story" @if($competition->type=='story') selected @endif>Story</option>
                <option value="art" @if($competition->type=='art') selected @endif>Art</option>
            </select>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $competition->end_date }}" required>
        </div>

        <div class="mb-3">
            <label>Prize</label>
            <input type="text" name="prize" class="form-control" value="{{ $competition->prize }}">
        </div>

        <button type="submit" class="btn btn-success" id="updateBtn">Update</button>
        <a href="{{ route('competitionlist') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
