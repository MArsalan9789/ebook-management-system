@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Submissions for: {{ $competition->title }}</h2>
        <a href="{{ route('competitionlist') }}" class="btn btn-secondary">Back to Competitions</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

     

    @if($submissions->isEmpty())
        <div class="alert alert-info">No submissions yet.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->user->name }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $submission->file) }}" target="_blank" class="btn btn-sm btn-info">
                            Download
                        </a>
                    </td>
                    <td>
                        @if($submission->status == 'winner')
                            <span class="badge bg-success">Winner</span>
                        @else
                            <span class="badge bg-secondary">Submitted</span>
                        @endif
                    </td>
                    <td>{{ $submission->created_at->format('d M, Y H:i') }}</td>
                    <td>
                        @if($submission->status != 'winner')
                        <button class="btn btn-success btn-sm"
                            onclick="confirmWinner('{{ route('competitionselectwinner', $submission->id) }}')">
                            Select Winner
                        </button>
                        @else
                        <button class="btn btn-success btn-sm" disabled>Winner</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
