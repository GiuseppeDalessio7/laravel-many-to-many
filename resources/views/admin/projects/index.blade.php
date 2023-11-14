@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Message: </strong> {{ session('message') }}
        </div>
    @endif


    <h1>All Project is here</h1>

    <div class="controls">
        <a class="btn btn-info text-white" href="{{ route('admin.projects.create') }}">AddNew</a>
    </div>

    <div class="table-responsive">
        <table
            class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
            <thead class="table-light">

                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Cover_Image</th>
                    <th>action</th>


                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($projects as $project)
                    <tr class="table-primary">
                        <td scope="row">{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            @if ($project->cover_image)
                                <img class="img-fluid w-25"
                                    src="{{ strstr($project->cover_image, 'http') ? $project->cover_image : asset('/storage/' . $project->cover_image) }}"
                                    alt="">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project->slug) }}" class=" btn btn-primary">View</a>
                            <a href="{{ route('admin.projects.edit', $project->slug) }}" class=" btn btn-dark">Edit</a>
                            <!-- Pulsante per aprire la modal di eliminazione -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalEliminaProgetto">
                                Delete
                            </button>

                            <!-- Modal di eliminazione -->
                            <div class="modal fade" id="modalEliminaProgetto" tabindex="-1" role="dialog"
                                aria-labelledby="mydeletemodal4me" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mydeletemodal4me">Conferma eliminazione</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Chiudi"></button>
                                        </div>
                                        <div class="modal-body">
                                            are you sure you want to delete {{ $project->title }}?
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Pulsante per chiudere la modal -->
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <!-- Pulsante per confermare l'eliminazione -->
                                            <form action="{{ route('admin.projects.destroy', $project->slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </td>



                    </tr>
                @empty

                    <tr class="table-primary">
                        <td scope="row">Item</td>

                    </tr>
                @endforelse


            </tbody>
            <tfoot>

            </tfoot>

        </table>
        <div class=" mx-auto pb-8">
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
