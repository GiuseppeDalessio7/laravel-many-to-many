@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row align-items-md-stretch">
            <div class="col-md-12 h-100 p-5 text-white bg-primary border rounded-3">
                <div class="row">
                    <div class="col-6">
                        <h2>{{ $project->title }}</h2>
                        <p>{{ $project->description }}</p>
                        <p>{{ $project->id }}</p>
                        <p><strong>Type: </strong>{{ $project->type?->name }}</p>
                        <ul class="d-flex gap-2 list-unstyled">
                            @forelse ($project->technologies as $technology)
                                <li class="badge bg-success">
                                    <i class="fa-solid fa-code"></i> {{ $technology->name }}
                                </li>
                            @empty
                                <li class="badge bg-secondary"><i class="fa-regular fa-file"></i> None/Others</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-6">
                        @if ($project->cover_image)
                            <img class="img-fluid" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
                        @endif
                    </div>
                </div>

            </div>

        </div>
        <div class="row mt-4">
            <div class="col-4 m-auto text-center">
                <a class="btn btn-success" href="{{ route('admin.projects.index') }}">Back to Projects</a>
            </div>
        </div>
    </div>
@endsection
