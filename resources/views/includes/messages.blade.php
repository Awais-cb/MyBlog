{{-- Laravel validation errors are going to be in error object --}}
{{-- @if ($errors->any()) --}}
@if(!empty($errors))
	@foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{$error}}		
		</div>
	@endforeach
@endif

@if(session('success'))
	<div class="alert alert-success alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{session('success')}}		
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{session('error')}}		
	</div>
@endif


