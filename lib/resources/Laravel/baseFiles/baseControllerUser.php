<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//Imports
use App\User;
use App\Role;
use App\Http\Requests\UserRequest;
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
    public function index(Request $request)
    {
        $take     = $request->get('take')?: 30;
        $skip     = $request->get('skip')?: 0;
        $users    = User::orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        $role     = array();
        foreach($users as $user){
            $sentinelroles = Sentinel::findById($user->id)->roles;
            $role[$user->id] = $sentinelroles[0]->name;
        }
        if(stristr($request->header('Accept'),'application/json')) return response()->json(compact('user','role'));
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
        ${model} = new \stdClass();
//{parents-relation}
        return view('user.create',compact('roles','userrole','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data         = $request->all();
        $user         = new User($data);
        $user->slug   = uniqid();
        $user->save();

        $sentineluser = Sentinel::findById($user->id);
        $roles        = Role::all();
        foreach($roles as $role){
            $sentinelrole = Sentinel::findRoleBySlug($role->slug);
            $sentinelrole->users()->detach($sentineluser);
        }
        $sentinelrole = Sentinel::findRoleBySlug($request->input('role'));
        $sentineluser->roles()->attach($sentinelrole);
        flash()->success('Entry has been created successfully.');

        if(stristr($request->header('Accept'),'application/json')) return response()->json($user);
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();
        $sentinelroles = Sentinel::findById($user->id)->roles;
        $role = $sentinelroles[0]->name;

//{children-relation}
        if(stristr($request->header('Accept'),'application/json')):
//{parent-relation}
          return response()->json(compact('user','role'));
        endif;

        return view('user.show',  compact('user','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $slug)
    {
        $roles          = Role::all();
        $user           = User::whereSlug($slug)->firstOrFail();
        $sentinelroles  = Sentinel::findById($user->id)->roles;
        $userrole       = $sentinelroles[0]->slug;

//{children-relation}
//{parents-relation}
        if(stristr($request->header('Accept'),'application/json')):
          return response()->json(compact('user','roles','userrole'));
        endif;

        return view('user.edit',  compact('user','roles','userrole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $slug)
    {
        $user         = User::whereSlug($slug)->firstOrFail();
        $sentineluser = Sentinel::findById($user->id);
        $roles        = Role::all();
        foreach($roles as $role){
            $sentinelrole = Sentinel::findRoleBySlug($role->slug);
            $sentinelrole->users()->detach($sentineluser);
        }
        $sentinelrole = Sentinel::findRoleBySlug($request->input('role'));
        $sentineluser->roles()->attach($sentinelrole);

        $user->update($request->all());
        flash()->success('Entry has been updated successfully.');

        if(stristr($request->header('Accept'),'application/json')) return response()->json($user);
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {

        $user = User::whereSlug($slug)->firstOrFail();
        $user->delete();
        if(stristr($request->header('Accept'),'application/json')) return response()->json($user);
    }
}
