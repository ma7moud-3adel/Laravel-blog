@extends('layouts.app')
@section('title')
index
@endsection()
@section('nav')
<p class="text-center text-success">We Are In Blade Home Page</p>
@endsection()
@section('body')
<div class="m-3">
  <div class="text-center">
    <a role="button" class="btn btn-success" href="{{route('posts.create')}}">Creat Post</a>
  </div>

  <table class="table text-center mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Created By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
      <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->created_at}}</td>
        <!-- <td>{{$post->created_at->addDays(35)->format('Y-m-d')}}</td> -->
        <td>
          <a class="btn btn-info" href="{{route('posts.show', $post->id)}}" target="_blank" role="button">View</a>

          <a class="btn btn-primary" href="{{route('posts.edit' , $post->id)}}" role="button">Edit</a>

          <form action="{{route('posts.destroy',$post->id)}}" method="POST" style="display: inline;">
            @csrf()
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Delete</button>
          </form>

        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <form class="text-center" action="{{route('posts.destroyAll')}}" method="POST">
    @csrf()
    @method('DELETE')
    <button class="btn btn-danger" type="submit" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Delete All</button>
  </form>
</div>
@endsection()