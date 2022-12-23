@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Text Management</h3></div>
                <div class="pull-right" style="color:black">
                    <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/Texts')}}">
                        <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
                        <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                        <a href="{{url('admin/Texts/create/')}}" class="btn btn-warning btn-sm">Add Text</a>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
            <tr>        
                <th class="text-center" width="5%">#</th>
                <th class="text-center">Key</th>
                <th class="text-center">Value</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
            
            <?php 
            $page = $texts->lastPage();
            $counter = ($texts->currentPage()-1) * $texts->perPage();
            $total = count($texts);
            ?>
            @foreach ($texts as $cnt)
                <?php $counter++; ?>
                <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td>{{$cnt->key}}</td>
                    <td>{{$cnt->details}}</td>
                    <td class="text-center">
                        <a href="{{url('admin/Texts/'.$cnt->id.'/edit')}}" title="Edit Content" class="edit_info">
                            <span class="glyphicon glyphicon-pencil"></span></a> &nbsp;
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $texts->links() !!}
</div>
@endsection
@section('scripts')
@endsection
