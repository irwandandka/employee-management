@extends('layouts.main')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Cities</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-9">
                            <form class="form-row align-items-center" method="GET" action="{{ route('cities.index') }}">
                                <div class="col">
                                    <input type="search" name="search" class="form-control mb-2">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('cities.create') }}" class="btn btn-primary mb-3 float-right">Create New City</a>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-success text-center">{{ session('message') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>State Name</th>
                                    <th>City Name</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $no => $city)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $city->state->name }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>
                                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('cities.destroy', $city->id) }}" class="d-inline-block" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection