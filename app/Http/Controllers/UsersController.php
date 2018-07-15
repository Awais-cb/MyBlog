<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->user_role!=1){
            return redirect('/posts')->with('error','Your are not authorized to access this url!');
        }
        $user = new User();
        $users = $user->orderBy('created_at')->paginate(20);

        return view('users.index')->with('users',$users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = new User();
        $userToEdit = $user->find($id);
        return view('dashboard.edit_profile')->with('user',$userToEdit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = new User();
        $userToUpdate = $user->find($id);
        if(auth()->user()->id != $userToUpdate->id){
            return redirect('/home')->with('error','Not authorized for this action!');
        }

        // Updating name
        $this->validate($request,[
            'name' => 'required|string|max:80',
            'email' => 'required|string|email|max:150'
        ]);
        $userToUpdate->name = $request->name;
        
        // Updating email
        if($userToUpdate->email != $request->email){
            $this->validate($request,[
                'email' => 'unique:users'
            ]);            
            $userToUpdate->email = $request->email;
        }
        
        // Updating password
        if(!empty($request->password) || $request->password!=NULL){
           $this->validate($request,[
                'password' => 'required|string|min:6|confirmed',
           ]);
            $userToUpdate->password = bcrypt($request->password);
        }

        $userToUpdate->save();
        return redirect('/users/'.$id.'/edit')->with('success','Your details has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->user_role != 1){
            return redirect('/posts')->with('error','Your are not authorized to access this url!');
        }
        $user = new User();
        $userToDelete = $user->find($id);
        $userToDelete->delete();
        return redirect('/users')->with('success','User deleted!');
    }
}
