@extends('partials.index')

@section('script-head')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

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

    {{-- head card --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $schedule->title }}</h5>
            <div class="d-flex gap-2 align-items-center justify-content-start">
                <p class="d-flex gap-2">
                    <span class="badge bg-dark text-light w-100">{{ $schedule->start_date }}</span>
                    to
                    <span
                        class="badge @if ($schedule->end_date < now()) bg-danger text-light @else bg-dark text-light @endif w-100">{{ $schedule->end_date }}</span>
                </p>
            </div>
            {{-- maps --}}
            <div id="map" style="width: 100%; height: 400px;"></div>
            <p class="mb-2">{!! $schedule->description !!}</p>
            <div class="mb-2 text-center d-flex gap-2 justify-content-center    ">
                <form action="{{ route('schedule.destroy', $schedule->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button title="mark complate" class="btn btn-dark" type="submit"><i class="bi bi-pin"></i></button>
                </form>
                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('schedule.update', $schedule->id) }}" method="post" class="needs-validation"
                        novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="title"
                                placeholder="input title schedule" required value="{{ $schedule->title }}">
                            <div class="invalid-feedback">please input</div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="start_date" class="form-label">Start Date:</label>
                                    <input name="start_date" type="date" class="form-control" id="start_date"
                                        placeholder="input start date time" required value="{{ $schedule->start_date }}">
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="end_date" class="form-label">End Date:</label>
                                    <input name="end_date" type="date" class="form-control" id="end_date"
                                        placeholder="input end date time" required value="{{ $schedule->end_date }}">
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="latitude" class="form-label">Latitude:</label>
                                    <input name="latitude" type="text" class="form-control" id="latitude"
                                        placeholder="input latitude" required value="{{ $schedule->latitude }}">
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="longitude" class="form-label">Longitude:</label>
                                    <input name="longitude" type="text" class="form-control" id="longitude"
                                        placeholder="input longitude" required value="{{ $schedule->longitude }}">
                                    <div class="invalid-feedback">please input</div>
                                </div>
                                <div class="mb-3">
                                    <!-- TinyMCE Editor -->
                                    <textarea name="description" class="tinymce-editor" id="description">
                                            {!! $schedule->description !!}
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

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Inisialisasi peta Leaflet
        var map = L.map('map').setView([{{ $schedule->latitude }}, {{ $schedule->longitude }}], 15);

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker ke posisi yang ditentukan
        L.marker([{{ $schedule->latitude }}, {{ $schedule->longitude }}]).addTo(map)
            .bindPopup('{{ $schedule->title }}');
    </script>
@endsection
