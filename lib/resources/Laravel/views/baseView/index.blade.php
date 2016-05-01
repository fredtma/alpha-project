@extends('app')
@section('navigation')
@include('navigation',['view' => array('_item_')])
@stop
@section('content')
<div class="content-wrapper">
    <div class="content-heading" style="font-size:20px;">
        _Model_s
        <small></small>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- START panel-->
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:18px;">All _Model_s</div>
                <div class="panel-body">
                    @include('flash::message')
                    <div style="margin-bottom: 15px;" class="text-right">
                        <a href="{{url('_item_/create')}}"><button class="btn btn-primary" style="font-size: 13px;"><i class="fa fa-plus"></i> Add Entry</button></a>
                    </div>
                    <input type="text" class="form-control input-sm m-b-md" id="filter" placeholder="Search...">
                    <div class="table-responsive">
                        <table id="datatable" class="footable table table-stripped toggle-arrow-tiny" data-page-size="10" data-filter=#filter data-sort="false">
                            <thead>
                            <tr>
                                _TableHeadings_
                                <th data-ignore="highlight" width="90px;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($_items_ as $_item_)
                            <tr class="gradeX">
                                _TableData_
                                <td data-sort-ignore="true" class="right">
                                    <a href="{{url('_item_/'.$_item_->slug)}}"><em class="icon-menu tableactions"></em>&nbsp;</a>
                                    <a href="{{url('_item_/'.$_item_->slug.'/edit')}}"><em class="icon-note tableactions"></em>&nbsp;</a>
                                    <a href="#"><em class="icon-trash tableactions deletemodal" data-token="{{ csrf_token() }}" data-id="{{ $_item_->slug }}"></em>&nbsp;</a>
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
                    </div><!-- responsive -->
                </div>
            </div>
            <!-- END panel-->
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
