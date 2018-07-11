	@extends('layouts.app')
	@section('content')
		{{-- @include('includes/carousel') --}}
		<div class="jumbotron text-center">
	        <h1>Welcome To MyBlog!</h1>
	        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio velit eveniet magnam illo, quibusdam iure fuga error sapiente molestias, debitis nemo quod repudiandae, itaque sed tempore quas porro quaerat omnis</p>
	        @guest
	        	<p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
	        @endguest
	    </div>
	@endsection