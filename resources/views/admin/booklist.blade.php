@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold mb-4">All Books</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>
                            @if ($book->cover)
                                <img src="{{ asset('storage/'.$book->cover) }}" alt="cover" width="60" height="80"
                                    style="object-fit:cover;">
                            @else
                                <span class="badge bg-secondary">No Cover</span>
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category }}</td>
                        <td class="text-success fw-bold">Rs {{ $book->price }}</td>
                        <td>
                            @if (intval($book->is_free) === 1)
                                ✅ Free Book
                            @else
                                ❌ Paid Book
                            @endif

                        </td>
                        <td>
                            <span
                                class="badge
                    @if ($book->status == 'available') bg-success
                    @elseif($book->status == 'completed') bg-warning
                    @else bg-secondary @endif">
                                {{ ucfirst($book->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($book->file)
                                <a href="{{ asset('storage/'.$book->file) }}" target="_blank" class="btn btn-sm btn-outline-info">View
                                    PDF</a>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bookedit', $book->id) }}" class="btn btn-sm btn-warning mb-1">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                            <!-- Delete with SweetAlert -->
                            <button class="btn btn-sm btn-danger mb-1" onclick="deleteBook({{ $book->id }})">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            <form id="delete-form-{{ $book->id }}" action="{{ route('bookdelete', $book->id) }}"
                                method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert Script -->
    <script>
        function deleteBook(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This book will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Optional: Success alert after CRUD
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection
