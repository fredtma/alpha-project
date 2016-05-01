<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//Imports
use App\_Model_;
use App\Role;
use App\Http\Requests\Create_Model_Request;
use App\Http\Requests\Update_Model_Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class _Model_Controller extends Controller
{
    public function __construct()
    {
        $user = Sentinel::findById(Auth::user()->id);
        if (!$user->hasAccess(['_item_'])){
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
        $_item_ = _Model_::all();
        return view('_item_.index',  compact('_item_'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_item_.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create_Model_Request $request)
    {
        _Model_::create($request->all());
        flash()->success('Entry has been created successfully.');
        return redirect('_item_');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_item_ = _Model_::findOrFail($id);
        return view('_item_.show',  compact('_item_'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $_item_ = _Model_::findOrFail($id);
        return view('_item_.edit',  compact('_item_'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update_Model_Request $request, $id)
    {
        $_item_ = _Model_::findOrFail($id);
        $_item_->update($request->all());
        flash()->success('Entry has been updated successfully.');
        return redirect('_item_');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_item_ = _Model_::findOrFail($id);
        $_item_->delete();
    }
}
