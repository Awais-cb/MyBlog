	@extends('layouts.app')
	@section('content')
		<h1>Users</h1>
		@if(!empty($users) && count($users)>0)
			<div class="well">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Userid</th>
							<th>Name</th>
							<th>Email</th>
							<th>Member since</th>
							<th>User role</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{$user->id}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->created_at}}</td>
							<td>
								@if($user->user_role==1) Admin
								@else Normal user @endif
							</td>
							
							<td>
							@auth
								@if($user->user_role!=1)	
									{!! Form::open(['action'=>['UsersController@destroy',$user->id],'method'=>'POST','onsubmit'=>'return confirm("Are you sure you want to delete this user?");']) !!}	
										{{Form::hidden('_method','DELETE')}}
										{{Form::submit('Delete user',['class'=>'btn btn-danger','data-toggle'=>'tooltip','data-placement'=>'left','title'=>"This will delete user as well as his all data!"])}}
									{!!Form::close()!!}
								@endif	
							@endauth
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			{{$users->links()}}
		@else
			<h3>No users found!</h3>
		@endif
	@endsection