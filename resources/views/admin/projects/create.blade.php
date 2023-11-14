@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-primary" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Create Post</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="title" class="form-control" name="title" id="title"
                        placeholder="Type your Project Title" @error('title') is-invalid @enderror placeholder="title"
                        aria-describedby="helperTitle" value="{{ old('title') }}">


                    <div class="mt-5"> <label for="cover_image">Image</label>
                        <input type="file" name="cover_image" class="form-control-file" id="cover_image"
                            @error('img_full') is-invalid @enderror placeholder="title" aria-describedby="helperTitle"
                            value="{{ old('img_full') }}">
                        <small class="text-muted">Add an image max 1000kb</small>
                    </div>

                    <div class="mb-3">
                        <label for="git_link" class="form-label">git link</label>
                        <input type="text" name="git_link" id="git_link" class="form-control"
                            @error('git_link') is-invalid @enderror placeholder="git_link" aria-describedby="helpergit_link"
                            value="{{ old('git_link') }}">
                        <small id="helpergit_link" class="text-muted">type your git project link</small>
                    </div>
                    @error('git_link')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror

                    <div class="mb-3">
                        <label for="project_link" class="form-label">external link</label>
                        <input type="text" name="project_link" id="project_link" class="form-control"
                            @error('project_link') is-invalid @enderror placeholder="project_link"
                            aria-describedby="helperproject_link" value="{{ old('project_link') }}">
                        <small id="helperproject_link" class="text-muted">type your project external link</small>
                    </div>
                    @error('project_link')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror


                    <div class="mb-3">
                        <span>Choose Type Project</span>

                        <label for="type_id" class="form-label">Type</label>
                        <select class="form-select form-select 
@error('type_id') is-invalid @enderror" name="type_id"
                            id="type_id">
                            <option selected>Select a Type</option>
                            <option value="">Uncategorized</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label for="description" class="form-label">description</label>
                            <textarea class="form-control" @error('description') is-invalid @enderror name="description" id="description"
                                rows="3"></textarea>
                        </div>
                        @error('content')
                            <span class="text-danger">
                                {{ message }}
                            </span>
                        @enderror
                    </div>


                    <div class=" mt-5"><button type="submit" class="btn btn-primary">Save</button></div>


            </form>
        </div>
    </div>
@endsection
