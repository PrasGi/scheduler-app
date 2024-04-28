@extends('partials.index')
@section('content')
    @error('error')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- head --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Schedule</h5>

            <nav>
                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </nav>

            <div class="">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create</button>
            </div>
        </div>
    </div>

    {{-- items --}}
    @if ($datas->isEmpty())
        @include('components.empty')
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Start date</th>
                    <th scope="col">Start end</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $data->title }}</td>
                        <td>
                            <span class="badge bg-dark text-light">{{ $data->start_date }}</span>
                        </td>
                        <td>
                            <span
                                class="badge @if ($data->end_date < now()) bg-danger text-light @else bg-dark text-light @endif">{{ $data->end_date }}</span>
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('schedule.show', $data->id) }}" title="go view"
                                class="btn btn-outline-dark"><i class="bi bi-eye"></i></a>
                            <form action="{{ route('schedule.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button title="mark complate" class="btn btn-dark" type="submit"><i
                                        class="bi bi-pin"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('schedule.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="title"
                                placeholder="input title schedule" required>
                            <div class="invalid-feedback">please input</div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="start_date" class="form-label">Start Date:</label>
                                    <input name="start_date" type="date" class="form-control" id="start_date"
                                        placeholder="input start date time" required>
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="end_date" class="form-label">End Date:</label>
                                    <input name="end_date" type="date" class="form-control" id="end_date"
                                        placeholder="input end date time" required>
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="latitude" class="form-label">Latitude:</label>
                                    <input name="latitude" type="text" class="form-control" id="latitude"
                                        placeholder="input latitude" required>
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="longitude" class="form-label">Longitude:</label>
                                    <input name="longitude" type="text" class="form-control" id="longitude"
                                        placeholder="input longitude" required>
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="mb-3">
                                    <!-- TinyMCE Editor -->
                                    <textarea name="description" class="tinymce-editor" id="description">
                                            <p>description ...</p>
                                    </textarea><!-- End TinyMCE Editor -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
@endsection
