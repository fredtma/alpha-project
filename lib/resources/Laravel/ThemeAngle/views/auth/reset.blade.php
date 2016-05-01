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
        @if (session('status'))
        <div class="alert alert-success">
            <strong>Success! </strong> {{ session('status') }}
        </div>
        @endif
        {!! Form::open(array('url' => '/password/reset','class'=>'m-t','role'=>'form')) !!}
                <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email Address" required="" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" required="" name="password" placeholder="Password">
        </div>       
        <div class="form-group">
            <input type="password" class="form-control" required="" name="password_confirmation" placeholder="Confirm Password">
        </div> 
        <button type="submit" class="btn btn-success btn-block">Reset</button>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6 text-left"><a href="{{url('login')}}"><p style="font-size: 11px; padding-right: 10px;">Already Registered?</p></a></div>
        </div>         
        {!! Form::close() !!}
    </div>
</div> 
@stop