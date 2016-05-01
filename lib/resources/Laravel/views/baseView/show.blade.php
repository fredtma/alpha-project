@extends('app')
@section('navigation')
@include('navigation',['view' => array('_item_')])
@stop
@section('content')
         <div class="content-wrapper">
            <div class="content-heading" style="font-size:20px;">
               _Model_
               <small></small>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <!-- START panel-->
                  <div class="panel panel-default">
                     <div class="panel-heading" style="font-size:18px;">View _Model_</div>
                     <div class="panel-body">
                    {!! Form::open(array('url' => ['_item_'],'class'=>'form-horizontal')) !!}
                    @include('_item_.partial',['readonly'=>true])
                    <div class="form-group" style="text-align: right;">
                        <div class="col-sm-12">
                            <a href='{{url('_item_')}}'><button class="btn btn-default" type="button" style="width: 80px; font-size: 13px;">Cancel</button></a>
                            <a href='{{url('_item_/'.$_item_->slug.'/edit')}}'><button class="btn btn-primary" type="button" style="width: 80px; font-size: 13px;">Edit</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                     </div>
                  </div>
                  <!-- END panel-->
               </div>
            </div>
         </div>
@stop
