@extends('layouts.app')

@section('content')
<form method="POST" action="/profile/{{ $user }}/edit" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group pt-3">
            
            <div class="row m-0">
                <div class="col-6 mx-auto">
                    <h2 style="text-align:center">Edit profile</h2>
                </div>
            </div>
            
            <div class="row col-8 mx-auto">
                <label for="title" class="col-form-label">{{ __('Title') }}</label>
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile()->first()->title }}" autocomplete="off" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row col-8 mx-auto">
                <label for="description" class="col-form-label">{{ __('Description') }}</label>
                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile()->first()->description }}" autocomplete="off" autofocus>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row col-8 mx-auto">
                <label for="link" class="col-form-label">{{ __('URL') }}</label>
                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') ?? $user->profile()->first()->link }}" autocomplete="off" autofocus>

                @error('link')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row col-8 mx-auto">
                <label for="image" class="col-form-label">Profile Image</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="profile_image">
                <small>Only jpeg, png less than 2MB</small>
                
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="row col-1 mt-4 mx-auto">
                <button class="btn btn-primary">Save</button>
            </div>

        </div>
    </form> 

@endsection
