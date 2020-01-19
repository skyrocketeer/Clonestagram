@extends('layouts.app')

@section('content')

@foreach($posts as $post)
    <div class="row m-0 justify-content-center">
        <img src="/storage/{{ $post->image }}" alt="post photos" class="d-block m-0" style="width:30%">
    </div>

    <div class="row m-0 pb-2">
        <a href="/profile/{{ $post->user->username }}" style="width: 5%">
            <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle d-block" style="width:70%">
        </a>
        <div class="d-flex my-auto" style="font-size:13px">
            <a href="/profile/{{ $post->user->username }}" class="pr-2 text-dark" >
                <strong>{{ $post->user->username }}</strong>
            </a>
            <span class="d-block pr-2">•</span>
            <a class="d-block" href="#">Follow</a>
        </div>
    </div>
    
    <div class="row m-0 ml-4 pl-3">
        <p>{{ $post->caption }}</p>
    </div>
    <hr>

@endforeach

<div class="row">
    <div class="col-12 mt-3 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
