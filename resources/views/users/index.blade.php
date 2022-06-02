@extends('layouts.main')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-9">
                            <form class="form-row align-items-center" method="GET" action="{{ route('users.index') }}">
                                <div class="col">
                                    <input type="search" name="search" class="form-control mb-2">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3 float-right">Create New User</a>
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $user)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" class="d-inline-block" method="POST">
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