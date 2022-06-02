@extends('layouts.main')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Departments</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-8">
                            <form class="form-row align-items-center" method="GET" action="{{ route('departments.index') }}">
                                <div class="col">
                                    <input type="search" name="search" class="form-control mb-2" placeholder="">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3 float-right">Create New Department</a>
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
                                    <th>Department Name</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $no => $department)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('departments.destroy', $department->id) }}" class="d-inline-block" method="POST">
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