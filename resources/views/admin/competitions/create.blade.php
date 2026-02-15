@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Add New Competition</h2>

    <form action="{{ route('competitionstore') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="essay">Essay</option>
                <option value="story">Story</option>
                <option value="art">Art</option>
            </select>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prize</label>
            <input type="text" name="prize" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('competitionlist') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
