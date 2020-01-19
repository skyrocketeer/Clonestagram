@extends('layouts.app')

@section('content')
<div class="row my-5 account-info">
    <div class="col-3 p-0 mx-3 my-auto">
        <div class="account-img">
            <img src="{{ $user->profile()->first()->profileImage() }}" alt="account-avatar" class="rounded-circle mx-auto d-block">
        </div>
    </div>
    <div class="col-8">
        <div class="row m-0 d-flex justify-content-between align-items-baseline account-name">
            <div class="pull-left d-flex">
                <h5 class="my-auto">{{ $user->username }}</h5>
                @cannot( 'viewFollowButton',$user->profile()->first() )
                    <follow-button user-id="{{ $user->id }}" followed="{{ $follows }}"></follow-button>
                @endcannot
            </div>

            @can( 'createPost', $user->profile()->first() )
                <a href="/p/create"><button class="btn btn-primary border-0 shadow-none" style="border-radius: 50px">Add new post</button></a>
            @endcan

        </div>

        @can( 'update', $user->profile )
        <div class="row m-0">
            <a href="/profile/{{ $user->username }}/edit" id="edit-pro5">Edit Profile</a>
        </div>
        @endcan

        <div class="row m-0 py-3 account-follows">
            <div class="pr-4"><b>{{ $postCount }}</b> posts</div> 
            <follow-num :followers="{{ $followersCount }}"></follow-num>
            <div><strong>{{ $followingCount }}</strong> following</div>     
        </div>
        <div class="row m-0 mt-2 d-flex flex-column account-meta">
            <div id="account-title"><b>{{ $user->profile()->first()->title }}</b></div>
            <div id="account-description">{!! $user->profile()->first()->description !!}</div>
            <div id="account-link"><a href="{{ $user->profile()->first()->link }}">{{ $user->profile()->first()->link }}</a></div>
        </div>
    </div>
</div>

<div class="row pt-3 account-posts">
    @foreach($user->posts as $post)
    <div class="col-4 stacked-img p-0 pb-5">
        <a href="/p/{{ $post->id }}"> 
            <img class="mx-auto d-block" src="/storage/{{ $post->image }}">
        </a>
    </div>
        @endforeach
</div>

@endsection