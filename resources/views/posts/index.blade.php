@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 1)
        @foreach($posts as $Post)
           <div class="card bg-light p-3">
           <h2 class="mb-0"><a href="posts/{{$Post->id}}">Post {{$Post->id}}</a></h2>
            <p>Made on {{$Post->created_at}}</p>
            </div>
        </br>
        @endforeach
    @else
        <p>No posts found</p>
    @endif
@endsection