@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Competitions</h2>
            <a href="{{ route('competitioncreate') }}" class="btn btn-success">Add New</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>End Date</th>
                    <th>Prize</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($competitions as $comp)
                    <tr>
                        <td>{{ $comp->id }}</td>
                        <td>{{ $comp->title }}</td>
                        <td>{{ ucfirst($comp->type) }}</td>
                        <td>{{ $comp->end_date }}</td>
                        <td>{{ $comp->prize }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm"
                                onclick="confirmEdit('{{ route('competitionedit', $comp->id) }}')">
                                Edit
                            </button>

                            <form method="POST" action="{{ route('competitiondelete', $comp->id) }}"
                                class="d-inline deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteForm(this)">
                                    Delete
                                </button>
                            </form>

                            <button class="btn btn-info btn-sm"
                                onclick="confirmSubmissions('{{ route('competitionsubmissions', $comp->id) }}')">
                                Submissions
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No competitions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
