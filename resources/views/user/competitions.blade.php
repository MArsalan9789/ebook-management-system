@extends('layouts.user')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold mb-2">Competitions</h2>
            <p class="text-muted mb-2">Participate and showcase your talent!</p>
        </div>

        @if ($competitions->isEmpty())
            <div class="alert alert-info text-center">
                No competitions available right now.
            </div>
        @else
            <div class="row g-4">
                @foreach ($competitions as $comp)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-3">
                                    <h5 class="fw-bold">{{ $comp->title }}</h5>
                                    <span class="badge bg-info text-dark">{{ ucfirst($comp->type) }}</span>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li><i class="fa fa-calendar me-2"></i>Deadline:
                                        <strong>{{ \Carbon\Carbon::parse($comp->end_date)->format('d M, Y') }}</strong></li>
                                    <li><i class="fa fa-trophy me-2"></i>Prize: <strong>{{ $comp->prize ?? 'N/A' }}</strong>
                                    </li>
                                </ul>

                                @auth
                                    <form method="post" action="{{ route('competition.submit', $comp->id) }}"
                                        enctype="multipart/form-data" class="mt-auto">
                                        @csrf
                                        <div class="mb-2">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            Submit Entry
                                        </button>
                                        @if ($comp->submissions->count() > 0)
                                            <p class="text-success mt-2"><strong>Winner:</strong>
                                                {{ $comp->submissions->first()->user->name }}</p>
                                        @else
                                            <p class="text-muted mt-2"><em>Winner not selected yet</em></p>
                                        @endif

                                    </form>
                                @else
                                    <p class="text-center text-danger mt-auto"><em>Login to participate</em></p>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4em 0.6em;
        }
    </style>
@endsection
