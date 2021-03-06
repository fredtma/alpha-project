@extends('app')
@section('navigation')
@include('navigation',['view' => array('_item_')])
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><i class="fa fa-th"></i> View _Model_</h5>
            </div>
            <div class="ibox-content">
                {!! Form::open(array('url' => ['_item_'],'class'=>'form-horizontal')) !!}
                @include('_item_.partial',['readonly'=>true])
                <div class="form-group" style="text-align: right;">
                    <div class="col-sm-12">
                        <a href='{{url('_item_')}}'><button class="btn btn-white" type="button" style="width: 80px;">Cancel</button></a>
                        <a href='{{url('_item_/'.$_item_->id.'/edit')}}'><button class="btn btn-primary" type="button" style="width: 80px;">Edit</button></a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop