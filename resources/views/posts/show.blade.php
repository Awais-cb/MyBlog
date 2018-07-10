	@extends('layouts.app')
	@section('content')
		<a href="/posts" class="btn btn-default">Go Back</a>
		@if(!empty($post))
			<h1>{{$post->title}}</h1>
			<div class="well" style="text-align: center;">
				<img style="max-height: 500px;" src="/storage/cover_images/{{$post->cover_image}}"  alt="{{$post->title}}">
			</div>
			<br>
			{{-- this will allow to parse the html too --}}
			<p>{!!$post->body!!}</p>
			<hr>
			<small>{{$post->created_at}} by {{$post->user->name}}</small>
			<hr>
			@if(!Auth::guest())
				@if(Auth::user()->id == $post->user_id || Auth::user()->user_role == 1)
				<a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
				
				{!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right','onsubmit'=>'return confirm("Are you sure you want to delete this post?")'])!!}
				{{Form::hidden('_method','DELETE')}}
				{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
				{!!Form::close()!!}
				@endif
			@endif
		@else
			<h3>Post not found!</h3>
		@endif
	@endsection