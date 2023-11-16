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
                        <label for="github" class="form-label">git link</label>
                        <input type="text" name="github" id="github" class="form-control"
                            @error('github') is-invalid @enderror placeholder="github" aria-describedby="helpergithub"
                            value="{{ old('github') }}">
                        <small id="helpergithub" class="text-muted">type your valid git project link</small>
                    </div>
                    @error('github')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror

                    <div class="mb-3">
                        <label for="r_link" class="form-label">external link</label>
                        <input type="text" name="r_link" id="r_link" class="form-control"
                            @error('r_link') is-invalid @enderror placeholder="r_link" aria-describedby="helperr_link"
                            value="{{ old('r_link') }}">
                        <small id="helperr_link" class="text-muted">type your valid project external link</small>
                    </div>
                    @error('r_link')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror


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



                    @error('technologies')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror



                    <div class="my-3">
                        <label for="technologies" class="form-label d-block"><strong>Technologies Used:</strong></label>
                        <div class="card p-2 d-flex flex-row">
                            @foreach ($technologies as $technology)
                                <div class="form-check mx-1">


                                    <input class="form-check-input @error('technologies') is-invalid @enderror"
                                        type="checkbox" id="technologies" name="technologies[]"
                                        aria-describedby="helpTechnology" value="{{ $technology->id }}"
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="technologies">{{ $technology->name }}</label>

                                </div>
                            @endforeach
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
