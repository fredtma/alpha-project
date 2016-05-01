@extends('auth')
@section('form')
<table style="width:100%">
    <tr>
        <td class="text-left" width="10%">&nbsp;</td>
        <td class="text-center" width="80%"><h3>Password Reset</h3></td>
        <td class="text-right" width="10%"><a href="{{url('/')}}"><h2><i class="pe-7s-home"></i></h2></a></td>
    </tr>
</table> 
<div class="hpanel">
    <div class="panel-body">
        @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 15px;">
            We can't find a user with that e-mail address.
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success" style="margin-bottom: 15px;">
            {{ session('status') }}
        </div>
        @endif
        {!! Form::open(array('url' => 'password/email','role'=>'form')) !!}
        <div class="form-group">
            <input type="email" class="form-control no-shadow" placeholder="Email Address" required="" name="email" value="{{ old('email') }}">
        </div>
        <button type="submit" class="btn btn-success btn-block">Submit</button>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6 text-left"><a href="{{url('login')}}"><p style="font-size: 11px; padding-right: 10px;">Back to Login</p></a></div>
        </div>         
        {!! Form::close() !!}
    </div>
</div> 
@stop