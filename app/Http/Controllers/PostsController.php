<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// To bring the model into controller
use App\Post;
// Using file lib
// To Fetch data without elequent
// use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Fetching data without elequent
        // $posts = DB::select('SELECT * FROM posts');
        // Fetching data using elequent

        // with elequent we can either use inheritance or we can use composition
        // $posts = Post::orderBy('created_at','DESC')->paginate(3);

        $post = new Post();
        $allPosts = $post->orderBy('created_at','DESC')->paginate(3);
        return view('posts.index')->with('posts',$allPosts);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:191',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            // Get just extension
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to stiore
            $fileNameToStore = $filename.'_'.time().'.'.$fileExt;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg'; 
        }



        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        // this message is going to be received by session('success') same goes for error session('error')
        return redirect('/posts')->with('success','Post created!');
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // with elequent we can either use inheritance or we can use composition
        // $postFound = Post::find($id);

        $post = new Post();
        $postFound = $post->find($id);
        return view('posts.show')->with('post',$postFound);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = new Post();
        $postFound = $post->find($id);
        if(auth()->user()->id !== $postFound->user_id && auth()->user()->user_role!=1){
            return redirect('/posts')->with('error','Your are not authorized to access this page!');
        }
        return view('posts.edit')->with('post',$postFound);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = new Post();
        $postToUpdate = $post->find($id);
        if(auth()->user()->id != $postToUpdate->user_id){
            return redirect('/posts')->with('error','Your are not authorized to edit this post!');
        }

        $this->validate($request,[
            'title'=>'required|max:191',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        $postToUpdate->title = $request->input('title');
        $postToUpdate->body = $request->input('body');
        
        // Preparing new file to update
        if($request->hasFile('cover_image')){
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToUpdate = $filename.'_'.time().'.'.$fileExt;
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToUpdate);
        }

        if($request->hasFile('cover_image')){
            // Removing old image from db
            if($postToUpdate->cover_image != 'noimage.jpg'){
                Storage::delete('public/cover_images/'.$postToUpdate->cover_image);
            }
            // Updating the same file with new one
            $postToUpdate->cover_image = $fileNameToUpdate;
        }
        $postToUpdate->save();
        return redirect('/posts/'.$id)->with('success','Post updated!');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = new Post();
        $postToDelete = $post->find($id);
        if(auth()->user()->id !== $postToDelete->user_id && auth()->user()->user_role!=1){
            return redirect('/posts')->with('error','Your are not authorized to access this functionality!');
        }
        if($postToDelete->cover_image != 'noimage.jpg'){
                Storage::delete('public/cover_images/'.$postToDelete->cover_image);
        }
        $postToDelete->delete();
        return redirect('/posts')->with('success','Post deleted!');   
    }
}
