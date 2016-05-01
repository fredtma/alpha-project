<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//Imports
use App\User;
use App\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $user = Sentinel::findById(Auth::user()->id);
        if (!$user->hasAccess(['user'])){
            return redirect('dashboard')->send();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $role = array();
        foreach($users as $user){
            $sentinelroles = Sentinel::findById($user->id)->roles;
            $role[$user->id] = $sentinelroles[0]->name;
        }
        return view('user.index',  compact('users','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $userrole = null;
        return view('user.create',compact('roles','userrole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->all());
        $sentineluser = Sentinel::findById($user->id);
        $roles = Role::all();
        foreach($roles as $role){
            $sentinelrole = Sentinel::findRoleBySlug($role->slug);
            $sentinelrole->users()->detach($sentineluser);
        }
        $sentinelrole = Sentinel::findRoleBySlug($request->input('role'));
        $sentineluser->roles()->attach($sentinelrole);
        flash()->success('Entry has been created successfully.');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $sentinelroles = Sentinel::findById($user->id)->roles;
        $role = $sentinelroles[0]->name;
        return view('user.show',  compact('user','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $sentinelroles = Sentinel::findById($user->id)->roles;
        $userrole = $sentinelroles[0]->slug;
        return view('user.edit',  compact('user','roles','userrole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $sentineluser = Sentinel::findById($id);
        $roles = Role::all();
        foreach($roles as $role){
            $sentinelrole = Sentinel::findRoleBySlug($role->slug);
            $sentinelrole->users()->detach($sentineluser);
        }
        $sentinelrole = Sentinel::findRoleBySlug($request->input('role'));
        $sentineluser->roles()->attach($sentinelrole);

        $user = User::findOrFail($id);
        $user->update($request->all());
        flash()->success('Entry has been updated successfully.');
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
