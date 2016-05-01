@extends('auth')
@section('form')
    <h3>Password Reset</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
             <strong>Error! </strong> We can't find a user with that e-mail address.
        </div>
    @endif
    @if (session('status'))
      <div class="alert alert-success">
          <strong>Success! </strong> {{ session('status') }}
      </div>
    @endif
    {!! Form::open(array('url' => 'password/email','class'=>'m-t','role'=>'form')) !!}
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email Address" required="" name="email" value="{{ old('email') }}">
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
        <a href="{{url('login')}}"><small>Back to Login</small></a>
    {!! Form::close() !!}
@stop