@extends('app')
@section('navigation')
@include('navigation',['view' => array('_item_')])
@stop
@section('content')
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <h2 class="font-light m-b-xs">
                _Model_
            </h2>
            <!--<small></small>-->
        </div>
    </div>
</div>
<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    Edit _Model_
                </div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {!! Form::model($_item_,array('method'=>'PATCH','url' => ['_item_',$_item_->id],'class'=>'form-horizontal')) !!}
                    @include('_item_.partial',['readonly'=>false,'view'=>'edit'])
                    <div class="form-group" style="text-align: right;">
                        <div class="col-sm-12">
                            <a href='{{url('_item_')}}'><button class="btn btn-default" type="button" style="width: 80px; font-size: 13px;">Cancel</button></a>
                            <button class="btn btn-success" type="submit" style="width: 80px; font-size: 13px;">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop