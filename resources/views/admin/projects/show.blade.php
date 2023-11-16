@extends('layouts.admin')



@section('content')
    <div class="mybody">
        <div class="container mt-2">
            <div class="row align-items-md-stretch">
                <div class="col-md-12 h-100 p-5 text-white bg-black border rounded-3 mt-2">
                    <div class="row">
                        <div class="col-6">
                            <h2>{{ $project->title }}</h2>
                            <p>{{ $project->description }}</p>
                            <p>{{ $project->id }}</p>
                            <p class="badge bg-danger"><strong>Type:
                                </strong>{{ isset($project->type->name) ? $project->type->name : 'Uncategorized' }}
                            </p>
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

                    <p><i class=" fa-solid fa-link "></i> <a href="{{ $project->r_link }}"
                            class="text-decoration-none text-danger">{{ $project->r_link }}</a></p>

                    <p><i class=" fa-brands  fa-github  "></i> <a href="{{ $project->github }}"
                            class="text-decoration-none  text-primary">{{ $project->github }}</a>
                    </p>

                </div>

            </div>
            <div class="row mt-4">
                <div class="col-4 m-auto text-center">
                    <a class="btn btn-success" href="{{ route('admin.projects.index') }}">Back to Projects</a>
                </div>
            </div>
        </div>
    </div>
@endsection
