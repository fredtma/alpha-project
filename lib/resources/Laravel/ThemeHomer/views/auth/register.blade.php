@extends('auth')
@section('form')
<table style="width:100%">
    <tr>
        <td class="text-left" width="10%">&nbsp;</td>
        <td class="text-center" width="80%"><h3>Registration</h3></td>
        <td class="text-right" width="10%"><a href="{{url('/')}}"><h2><i class="pe-7s-home"></i></h2></a></td>
    </tr>
</table> 
<div class="hpanel">
    <div class="panel-body">
        @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 15px;">
            <?php
            foreach ($errors->all() as $error) {
                $message = str_replace('firstname', 'First Name', $error);
                $message = str_replace('lastname', 'Last Name', $message);
                $message = str_replace('email', 'Email Address', $message);
                $message = str_replace('password', 'Password', $message);
                echo '<li>' . $message . '</li>';
            }
            ?>
        </div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success" style="margin-bottom: 15px;">
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        {!! Form::open(array('url' => 'register','role'=>'form')) !!}
        <div class="form-group">
            <input type="text" placeholder="First Name" required='' name="firstname" id="firstname" value="{{ old('firstname') }}" class="form-control no-shadow">
        </div>
        <div class="form-group">
            <input type="text" placeholder="Last Name" required='' name="lastname" id="lastname" value="{{ old('lastname') }}" class="form-control no-shadow">
        </div>
        <div class="form-group">
            <input type="email" placeholder="Email Address" required='' name="email" id="email" value="{{ old('email') }}" class="form-control no-shadow">
        </div>
        <div class="form-group">
            <input type="email" placeholder="Confirm Email Address" required='' name="email_confirmation" id="email_confirmation" class="form-control no-shadow">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Password" required='' name="password" id="password" class="form-control no-shadow">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Confirm Password" required='' name="password_confirmation" id="password_confirmation" class="form-control no-shadow">
        </div>
        <button type="submit" class="btn btn-success btn-block">Register</button>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6 text-left"><a href="{{url('login')}}"><p style="font-size: 11px; padding-right: 10px;">Already Registered?</p></a></div>
        </div>         
        {!! Form::close() !!}
    </div>
</div> 
@stop