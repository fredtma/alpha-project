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
                    View _Model_
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url' => ['_item_'],'class'=>'form-horizontal')) !!}
                    @include('_item_.partial',['readonly'=>true])
                    <div class="form-group" style="text-align: right;">
                        <div class="col-sm-12">
                            <a href='{{url('_item_')}}'><button class="btn btn-default" type="button" style="width: 80px; font-size: 13px;">Cancel</button></a>
                            <a href='{{url('_item_/'.$_item_->id.'/edit')}}'><button class="btn btn-success" type="button" style="width: 80px; font-size: 13px;">Edit</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop