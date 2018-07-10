	@extends('layouts.app')
	@section('content')
		<h1>Update post</h1>
        {{-- parsing post id so we could be able to identify post --}}
		{!! Form::open(['action' => ['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    		<div class="form-group">
    			{{Form::label('title','Title')}}
    			{{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
    			{{Form::label('body','Body')}}
    			{{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body'])}}
    		</div>
                {{-- To make put request in laravel --}}
                {{Form::hidden('_method','PUT')}}
                <div class="form-group">
                    {{Form::file('cover_image',['class'=>'btn btn-default'])}}
                </div>
    			{{Form::submit('Update',['class'=>'btn btn-primary'])}}
                <a href="/posts/{{$post->id}}" title="Cancle" class="btn btn-default">Cancle</a>
		{!! Form::close() !!}
    @endsection