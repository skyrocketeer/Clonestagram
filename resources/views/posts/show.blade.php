@extends('layouts.app')

@section('content')
<div class="row m-0 mt-4 p-0">
    <div class="col-5 p-0">
        <img src="/storage/{{ $post->image }}" alt="post photos" class="img-responsive single-img d-block m-0">
    </div>
    <div class="col-7 p-0">
        <div class="row m-0">
            <div class="col-3 p-0"> 
                <a href="/profile/{{ $post->user->id }}">
                    <img src="/storage/{{ $post->user->profile->image }}" class="img-responsive rounded-circle d-block mx-auto" style="width: 40%">
                </a>
                
            </div>
            <div class="col-8 d-flex p-0 align-items-center" style="font-size: 13px">
                <a href="/profile/{{ $post->user->id }}" class="pr-1 text-dark">
                    <strong>{{ $post->user->username }}</strong>
                </a>
                <span class="d-block p-1">•</span>
                <a class="d-block pl-1" href="#">Follow</a>
            </div>
        </div>
        <hr>

        <div class="row m-0">
            <div class="col-3 p-0">
                <a href="/profile/{{ $post->user->id }}">
                    <img src="/storage/{{ $post->user->profile->image }}" class="img-responsive rounded-circle d-block mx-auto" style="width: 40%">
                </a>
            </div>
            <div class="col-8 d-flex p-0 align-items-center" style="font-size: 13px">
                <a href="/profile/{{ $post->user->id }}" class="pr-1 text-dark">
                    <strong>{{ $post->user->username }}</strong>
                </a>
                <span class="pl-2 d-block">{{ $post->caption }}</span>
            </div>
        </div>
    
        @can('delete', $post)
            <div class="row m-0">
                <div class="col-10 m-5 p-2">
                    <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger p-1" type="submit">Delete post</button>               
                    </form>
                </div>
            </div>
        @endcan

    </div>
</div>


@endsection
