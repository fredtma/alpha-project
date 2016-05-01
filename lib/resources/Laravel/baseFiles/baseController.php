<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//Imports
use App\{Model} as {Eloquent};
use App\Role;
use App\Http\Requests\{Model}Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Support\Helper;

class {Model}Controller extends Controller
{
    public function __construct()
    {
        $user = Sentinel::findById(Auth::user()->id);
        if (!$user->hasAccess(['{model}'])){
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
        ${models} = {Eloquent}::orderBy('created_at', 'desc')->skip($skip)->take($take)->get();

        if(stristr($request->header('Accept'),'application/json')) return response()->json(${models});
        return view('{model}.index',  compact('{models}'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ${model} = new \stdClass();
//{parents-relation}
        return view('{model}.create', compact('{model}'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store({Model}Request $request)
    {
        $data           = $request->all();
        ${model}        = new {Eloquent}($data);
        ${model}->slug  = uniqid();
        ${model}->save();
        flash()->success('Entry has been created successfully.');

        if(stristr($request->header('Accept'),'application/json')) return response()->json(${model});
        return redirect('{model}');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        ${model} = {Eloquent}::whereSlug($slug)->firstOrFail();

//{children-relation}
        if(stristr($request->header('Accept'),'application/json')):
//{parent-relation}
          return response()->json(${model});
        endif;
        return view('{model}.show',  compact('{model}'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $slug)
    {
        ${model} = {Eloquent}::whereSlug($slug)->firstOrFail();
//{children-relation}
//{parents-relation}
        if(stristr($request->header('Accept'),'application/json')):
          return response()->json(${model});
        endif;
        return view('{model}.edit',  compact('{model}'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update({Model}Request $request, $slug)
    {
        ${model} = {Eloquent}::whereSlug($slug)->firstOrFail();
        ${model}->update($request->all());
        flash()->success('Entry has been updated successfully.');

        if(stristr($request->header('Accept'),'application/json')) return response()->json(${model});
        return redirect('{model}');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        ${model} = {Eloquent}::whereSlug($slug)->firstOrFail();
        ${model}->delete();
        if(stristr($request->header('Accept'),'application/json')) return response()->json(${model});
    }
}
