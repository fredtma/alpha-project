@extends('auth')
@section('form')
<table style="width:100%">
    <tr>
        <td class="text-left" width="10%">&nbsp;</td>
        <td class="text-center" width="80%"><p style="font-size:22px;">Sign In</p></td>
        <td class="text-right" width="10%"><a href="{{url('/')}}"><p style="font-size:21px;"><i class="icon-home"></i></p></a></td>
    </tr>
</table> 
@if($errors->any())
<div class="alert alert-danger" style="margin-bottom: 15px;">
    <?php
    foreach ($errors->all() as $error) {
        $search = strpos($error, 'inactive');
        if ($search !== false) {
            echo 'Your account is currently inactive. Please check the email sent during registration for further instructions.';
        } else {
            echo 'Login credentials are incorrect.';
        }
        break;
    }
    ?>
</div>
@endif
@if (Session::has('success'))
<div class="alert alert-success" style="margin-bottom: 15px;">
    <p>{{ Session::get('success') }}</p>
</div>
@endif       
@if (Session::has('error'))
<div class="alert alert-danger" style="margin-bottom: 15px;">
    <p>{{ Session::get('error') }}</p>
</div>
@endif   
@if (Session::has('warning'))
<div class="alert alert-warning" style="margin-bottom: 15px;">
    <p>{{ Session::get('warning') }}</p>
</div>
@endif          
{!! Form::open(array('url' => 'login','role'=>'form')) !!}
<div class="form-group">
    <input type="email" placeholder="Email Address" required="" value="{{ old('email') }}" name="email" id="email" class="form-control no-shadow">
</div>
<div class="form-group">
    <input type="password" class="form-control no-shadow" placeholder="Password" required="" name="password" id="password">
</div>
<button type="submit" class="btn btn-primary btn-block">Sign In</button>
<div style="margin-top: 10px;">
    <table style="width:100%">
        <tr>
            <td class="text-left" width="50%"><a href="{{url('register')}}"><p style="font-size: 11px;">Register New Account</p></a></td>
            <td class="text-right" width="50%"><a href="{{url('password/email')}}"><p style="font-size: 11px;">Forgot Password?</p></a></td>
        </tr>
    </table>             
</div> 
{!! Form::close() !!}
@stop