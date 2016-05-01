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
                    _Model_s
                </div>
                <div class="panel-body">
                    @include('flash::message')
                    <div style="margin-bottom: 15px;" class="text-right">
                        <a href="{{url('_item_/create')}}"><button class="btn btn-success" style="font-size: 13px;"><i class="fa fa-plus"></i> Add Entry</button></a>
                    </div>
                    <input type="text" class="form-control input-sm m-b-md" id="filter" placeholder="Search...">
                    <table id="datatable" class="footable table table-stripped toggle-arrow-tiny" data-page-size="10" data-filter=#filter data-sort="false">
                        <thead>
                        <tr>
                            _TableHeadings_
                            <th data-ignore="highlight" width="90px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($_item_ as $_item_)
                        <tr class="gradeX">
                            _TableData_
                            <td data-sort-ignore="true" class="right">
                                <a href="{{url('_item_/'.$_item_->id)}}"><i class="pe-7s-search tableactions"></i>&nbsp;</a>
                                <a href="{{url('_item_/'.$_item_->id.'/edit')}}"><i class="pe-7s-pen tableactions"></i>&nbsp;</a>
                                <a href="#"><i class="pe-7s-trash tableactions deletemodal" data-token="{{ csrf_token() }}" data-id="{{ $_item_->id }}"></i>&nbsp;</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5" id="pagination">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('pagescripts')
<script src="{{asset('vendor/fooTable/dist/footable.all.min.js')}}"></script>
@include('indexscript',['controller' => '_item_'])
@stop
@section('pagestyles')
<link href="{{asset('vendor/fooTable/css/footable.core.min.css')}}" rel="stylesheet">
@stop
