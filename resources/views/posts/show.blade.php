@extends('layouts.app')
@section('title')
show
@endsection()
@section('nav')
<p class="text-center text-success">We Are In Blade Show Page</p>
@endsection()

@section('body')
<div class="d-flex flex-column gap-3 m-3">
    <div class="card">
        <h5 class="card-header">Post Info</h5>
        <div class="card-body ms-2">
            <h5 class="card-title">Title : {{$post->title}}</h5>
            <p class="card-text">Description :{{$post->description}}</p>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Post Crearor Info</h5>
        <div class="card-body ms-2">
            <h5 class="card-title">Name : {{$post->user? $post->user->name : 'Not Found'}}</h5>
            <p class="card-text">E-mail : {{$post->user? $post->user->email : 'Not Found' }}</p>
            <p class="card-text">Created_At : {{$post->created_at}}</p>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between">
    <div>
        <a role="button" class="btn btn-secondary" href="{{route('posts.index')}}">Home</a>
    </div>
    <div>
        <a role="button" class="btn btn-danger" href="{{route('posts.show', $post->id-1)}}">Back</a>
        <a role="button" class="btn btn-success" href="{{route('posts.show', $post->id+1)}}">Next</a>
    </div>
</div>
@endsection