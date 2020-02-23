@extends('layouts.app')

@section('content')
<div class="row m-0 p-0">
    <div class="col-8 mx-auto">
        <form method="POST" action="/p" enctype="multipart/form-data">
            @csrf

            <div class="row m-0 justify-content-center">
                <h2>Add new post</h2>
            </div>
            
            <div class="row m-0">
                <label for="caption" class="col-4 pl-0 col-form-label"><strong>{{ __('Caption') }}</strong></label>
                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>

                @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row m-0">
                <label for="image" class="col-4 pl-0 col-form-label"><strong>Post Image</strong></label>
                <input type="file" class="form-control-file" name="image" id="image">
                
                @error('image')
                    <strong>{{ $message }}</strong>
                @enderror
            </div>
            
            <div class="row mt-4 justify-content-center">
                <button class="btn btn-primary">Add post</button>
            </div>

        </form>
    </div> 
</div>
@endsection
