@extends('layouts.app')
@section('content')
	<h1>Update details</h1>
    <form method="POST" action="/users/{{$user->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            
            <label for="name">name</label> 
            <input placeholder="Name" name="name" type="text" value="{{$user->name}}" id="name" class="form-control"> 
            
            <label for="email">Email</label> 
            <input placeholder="Email" name="email" type="email" value="{{$user->email}}" id="email" class="form-control"> 

            <label for="change password">Change password</label> 
            <input id="password" name="password" type="password" class="form-control" placeholder="Change password">

            <label for="confirm password">Confirm password</label> 
            <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
            
            <input name="_method" type="hidden" value="PUT"> 
        </div> 
        
        <input type="submit" value="Update" class="btn btn-primary"> 
        <a href="/home" title="Cancle" class="btn btn-default">Cancle</a>
    </form>
@endsection