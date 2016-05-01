@extends('auth')
@section('form')
    <h3>Password Reset</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <strong>Error! </strong> {{ $error }}
                <?break;?>
            @endforeach
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
        <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>
        <a href="{{route('login')}}"><small>Back to Login</small></a>
    {!! Form::close() !!}
@stop