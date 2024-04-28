@extends('partials.index')
@section('content')
    {{-- head --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">User</h5>

            <nav>
                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </nav>
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
                    <th scope="col">name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->role->name }}</td>
                        <td class="d-flex gap-2">
                            <form action="{{ route('user.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button title="kick user from sistem" class="btn btn-outline-danger" type="submit"><i
                                        class="bi bi-arrow-left"> kick</i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
