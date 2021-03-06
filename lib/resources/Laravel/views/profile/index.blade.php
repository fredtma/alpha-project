@extends('app')
@section('navigation')
@include('navigation',['view' => array('profile')])
@stop
@section('content')
<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Title
                </div>
                <div class="panel-body">
                    Content
                </div>
            </div>
        </div>
    </div>
</div>
@stop