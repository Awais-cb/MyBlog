	@extends('layouts.app')
	@section('content')
		<h1>Posts</h1>
		@if(!empty($posts) && count($posts)>0)
			@foreach($posts as $post)
				<div class="well">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="well" style="text-align: center;">
								<img style="max-height: 300px; width: 100%;" src="/storage/cover_images/{{$post->cover_image}}"  alt="{{$post->title}}">
							</div>
						</div>
						<div class="col-md-8 col-sm-8">
							<h1><a href="/posts/{{$post->id}}">{{$post->title}}</a></h1>
							<small>Written on :{{$post->created_at}} by {{$post->user->name}}</small>
							{{-- this will allow to parse the html too --}}
							<p>{!! $post->body !!}</p>
						</div>
					</div>
				</div>
			@endforeach
			{{$posts->links()}}
		@else
			<h3>No posts found!</h3>
		@endif
	@endsection