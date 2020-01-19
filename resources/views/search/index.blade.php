@extends('layouts.app')

@section('content')

@if(isset($users))
    <h4> Search result for your query: <strong> {{ $query }} </strong> </h4>
    <hr>
    @foreach($users as $user)
        <div class="row m-0 mb-4 pb-3">
            <a href="/profile/{{ $user->username }}" class="col-9 d-flex">
                <div class="col-2 my-auto">
                    <img src="storage/{{ $user->profile->image }}" alt="profile image" class="rounded-circle d-block mx-auto" style="width: 35%">
                </div>
                <div class="col-6 align-items-center" style="color:black">
                    <span class="d-block" style="font-weight: 800"> {{ $user->username }} </span>
                    <span class="d-block" style="font-style: oblique"> {{ $user->name }} </span>
                </div>
            </a>
        </div>
    @endforeach
@else
    <h3> {{ $message }} </h3>
@endif
@endsection