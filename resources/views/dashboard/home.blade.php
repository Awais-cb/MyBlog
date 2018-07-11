@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" title="Create Post" class="btn btn-primary">Create Post</a>
                    <h3>Your Blog Posts</h3>
                    @if(!empty($posts) && count($posts)>0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a class="btn btn-primary pull-right" href="/posts/{{$post->id}}/edit">Edit</a></td>
                                <td>
                                {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right','onsubmit'=>'return confirm("Are you sure you want to delete this post?")'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <h5>
                            No posts found!
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
