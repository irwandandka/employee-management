@extends('layouts.main')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Edit State</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card shadow-lg">
                <div class="card-body">
        
                    <form method="POST" action="{{ route('states.update', $state->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('State Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $state->name ?? old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country_code" class="col-md-4 col-form-label text-md-end">{{ __('Country Name') }}</label>
                            <div class="col-md-6">
                                <select name="country_id" class="form-control" id="country_id">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ $state->country_id === $country->id ? 'selected' : '' }}>{{  $country->name }}</option>
                                    @endforeach
                                </select>                                
                                @error('country_code')
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