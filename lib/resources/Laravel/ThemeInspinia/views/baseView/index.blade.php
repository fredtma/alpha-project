@extends('app')
@section('navigation')
@include('navigation',['view' => array('_item_')])
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><i class="fa fa-th"></i> _Model_s</h5>
            </div>
            <div class="ibox-content">
                @include('flash::message')
                <div style="margin-bottom: 10px;">
                    <a href="{{url('_item_/create')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Entry</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover datatable" >
                        <thead>
                            <tr>
                                _TableHeadings_
                                <th style="width: 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($_item_ as $_item_)
                            <tr class="gradeX">
                                _TableData_
                                <td class="right">
                                    <a href="{{url('_item_/'.$_item_->id)}}"><i class="fa fa-search tableactions"></i>&nbsp;</a>
                                    <a href="{{url('_item_/'.$_item_->id.'/edit')}}"><i class="fa fa-pencil tableactions"></i>&nbsp;</a>
                                    <a href="#"><i class="fa fa-trash tableactions deletemodal" data-token="{{ csrf_token() }}" data-id="{{ $_item_->id }}"></i>&nbsp;</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('pagescripts')
<script src="{{asset('js/plugins/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.tableTools.min.js')}}"></script>
<script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
@include('indexscript',['controller' => '_item_'])
@stop
@section('pagestyles')
<link href="{{asset('css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.tableTools.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@stop