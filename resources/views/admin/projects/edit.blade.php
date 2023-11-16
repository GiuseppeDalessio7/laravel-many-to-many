@extends('layouts.admin')

@section('content')
    <h1>edit project: {{ $project->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert</strong>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        @error('title') is-invalid @enderror placeholder="title" aria-describedby="helperTitle"
                        value="{{ old('title', $project->title) }}">
                    <small id="helperTitle" class="text-muted">type your project title max:50 characters</small>
                </div>
                @error('title')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror

                <div class="mb-3">
                    <label for="github" class="form-label">git link</label>
                    <input type="text" name="github" id="github" class="form-control"
                        @error('github') is-invalid @enderror placeholder="github" aria-describedby="helpergithub"
                        value="{{ old('github', $project->github) }}">
                    <small id="helpergithub" class="text-muted">type your git project link</small>
                </div>
                @error('git_link')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror

                <div class="mb-3">
                    <label for="r_link" class="form-label">external link</label>
                    <input type="text" name="r_link" id="r_link" class="form-control"
                        @error('r_link') is-invalid @enderror placeholder="r_link" aria-describedby="helperr_link"
                        value="{{ old('r_link', $project->r_link) }}">
                    <small id="helperr_link" class="text-muted">type your project external link</small>
                </div>
                @error('r_link')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror

                <div class="mb-3">
                    <div class="mb-3">
                        <span>Choose Type Project</span>

                        <label for="type_id" class="form-label">Type</label>
                        <select
                            class="form-select form-select 
                            @error('type_id') is-invalid @enderror"
                            name="type_id" id="type_id">
                            <option selected>Select a Type</option>
                            <option value="">Uncategorized</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 ">
                        <div>
                            <img width="200" src="{{ asset('/storage/' . $project->cover_image) }}" alt="">
                        </div>
                        <label for="cover_image" class="form-label">Choose file</label>
                        <input type="file" class="form-control" @error('cover_image') is-invalid @enderror
                            name="cover_image" id="cover_image" placeholder="choose a file" aria-describedby="fileHelp">
                        <div id="fileHelp" class="form-text">add an image max 1000kb</div>
                    </div>
                    @error('cover_image')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror

                    <div class="my-3">
                        <label for="technologies" class="form-label d-block"><strong>Technologies Used:</strong></label>
                        <div class="card p-2 d-flex flex-row">
                            @foreach ($technologies as $technology)
                                <div class="form-check mx-1">

                                    {{-- VIENE DATO UN ARRAY COME NAME PER ACCETTARE SCELTE MULTIPLE --}}
                                    @if ($errors->any())
                                        <input class="form-check-input @error('technologies') is-invalid @enderror"
                                            type="checkbox" id="technologies" name="technologies[]"
                                            aria-describedby="helpTechnology" value="{{ $technology->id }}"
                                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                    @else
                                        <input class="form-check-input @error('technologies') is-invalid @enderror"
                                            type="checkbox" id="technologies" name="technologies[]"
                                            aria-describedby="helpTechnology" value="{{ $technology->id }}"
                                            {{-- SE $project->technologies CONTIENE LA TECHNOLOGY CICLATA LA SELEZIONA --}}
                                            {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                                    @endif
                                    <label class="form-check-label" for="technologies">{{ $technology->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        @error('technologies')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" @error('description') is-invalid @enderror name="description" id="description"
                            rows="3">{{ old('description', $project->description) }}</textarea>
                    </div>


                    @error('description')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror

                    <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
@endsection
