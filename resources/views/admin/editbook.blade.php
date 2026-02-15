{{-- @extends('layouts.admin')

@section('content')
    <h2>Edit Book</h2>

    <form action="{{ route('bookupdate', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ $book->category }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $book->price }}" required>
        </div>

        <div class="mb-3">
            <label>Is Free?</label>
            <input type="hidden" name="is_free" value="0">
            <input type="checkbox" name="is_free" value="1" {{ !empty($book) && $book->is_free ? 'checked' : '' }}>
            <small class="text-muted">Check if this book is free for users</small>
        </div>


        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="completed" {{ $book->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">PDF File</label>
            @if ($book->file)
                <p>Current: <a href="{{ asset($book->file) }}" target="_blank">View PDF</a></p>
            @endif
            <input type="file" name="file" class="form-control" accept="application/pdf">
        </div>

        <div class="mb-3">
            <label>Preview File (PDF)</label>
            <input type="file" name="preview_file" class="form-control">
            @if (!empty($book) && $book->preview_file)
                <small>Existing Preview: {{ $book->preview_file }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Cover Image</label>
            @if ($book->cover)
                <p>Current: <img src="{{ asset($book->cover) }}" width="100"></p>
            @endif
            <input type="file" name="cover" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
@endsection --}}

@extends('layouts.admin')

@section('content')
    <h2>Edit Book</h2>

    <form action="{{ route('bookupdate', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <option value="">-- Select Category --</option>
                <option value="business">Business</option>
                <option value="technology">Technology</option>
                <option value="romantic">Romantic</option>
                <option value="adventure">Adventure</option>
                <option value="fictional">Fictional</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $book->price }}" required>
        </div>

        <div class="mb-3">
            <label>Is Free?</label>

            <input type="hidden" name="is_free" value="0">
            <input type="checkbox" name="is_free" value="1" {{ !empty($book) && $book->is_free ? 'checked' : '' }}>
            <small class="text-muted">Check if this book is free for users</small>
        </div>


        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="completed" {{ $book->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">PDF File</label>
            @if ($book->file)
                <p>Current: <a href="{{ asset($book->file) }}" target="_blank">View PDF</a></p>
            @endif
            <input type="file" name="file" class="form-control" accept="application/pdf">
        </div>

        <div class="mb-3">
            <label>Preview File (PDF)</label>
            <input type="file" name="preview_file" class="form-control">
            @if ($book->preview_file)
                <small>Existing Preview: {{ $book->preview_file }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Cover Image</label>
            @if ($book->cover)
                <p>Current: <img src="{{ asset($book->cover) }}" width="100"></p>
            @endif
            <input type="file" name="cover" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
@endsection
