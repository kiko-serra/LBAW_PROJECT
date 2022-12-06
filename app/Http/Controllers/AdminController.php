<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortBy("name");
        return view('pages.adminShow', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_tag'=> 'required|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'birthday' => 'required|date',
            'university' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User([
            'account_tag' => $request->get('account_tag'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'birthday' => $request->get('birthday'),
            'university' => $request->get('university'),
            'course' => $request->get('course'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->save();
        return redirect('/users')->with('success', 'User has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $user = User::find($id);
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
    }

    public function block($id_user)
    {
        $user = User::find($id_user);
        $user->is_blocked = true;
        $user->save();
        return redirect('/users')->with('success', 'User has been blocked');
    }

    public function unblock($id_user)
    {   
        $user = User::find($id_user);
        $user->is_blocked = false;
        $user->save();
        return redirect('/users')->with('success', 'User has been unblocked');
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User has been deleted');
    }
}