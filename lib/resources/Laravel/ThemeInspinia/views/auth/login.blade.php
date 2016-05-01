@extends('auth')
@section('form')
    <h3>Authentication</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Error! </strong> Login credentials are incorrect.
        </div>
    @endif
    {!! Form::open(array('url' => 'login','class'=>'m-t','role'=>'form')) !!}
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email Address" required="" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        <a href="{{url('password/email')}}"><small>Forgot password?</small></a>
    {!! Form::close() !!}
@stop