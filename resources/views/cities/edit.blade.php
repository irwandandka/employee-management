@extends('layouts.main')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Edit City</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card shadow-lg">
                <div class="card-body">
        
                    <form method="POST" action="{{ route('cities.update', $city->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('City Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $city->name ?? old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-end">{{ __('State Name') }}</label>
                            <div class="col-md-6">
                                <select name="state_id" class="form-control" id="state_id">
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ $city->state_id === $state->id ? 'selected' : '' }}>{{  $state->name }}</option>
                                    @endforeach
                                </select>                                
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection