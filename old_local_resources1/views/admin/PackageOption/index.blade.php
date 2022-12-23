@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Package Options  Management</h3></div>
                <div class="pull-right" style="color:black">
                    <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/PackageOptions')}}">
                        <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
                        <select name="active" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
                            <option value="-1" @if($active == -1) {{ 'selected="selected"' }} @endif>All</option>
                            <option value="0" @if($active == 0) {{ 'selected="selected"' }} @endif>Deleted</option>
                            <option value="1" @if($active == 1) {{ 'selected="selected"' }} @endif>Active</option>
                        </select>
                        <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                        <a href="{{url('admin/PackageOptions/create/')}}" class="btn btn-warning btn-sm">Add Package Option</a>                
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
            <tr>        
                <th class="text-center" width="5%">#</th>
                <th class="text-center">Title</th>
                <th class="text-center" width="5%">Basic</th>
                <th class="text-center" width="5%">{{getPlanTitle('silver')}}</th>
                <th class="text-center" width="5%">{{getPlanTitle('gold')}}</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
            
            <?php 
            $page = $packageOptions->lastPage();
            $counter = ($packageOptions->currentPage()-1) * $packageOptions->perPage();
            $total = count($packageOptions);
            ?>
            @foreach ($packageOptions as $cnt)
                <?php $counter++; ?>
                <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td>{{$cnt->text}}</td>
                    <td><span class="{{$cnt->basic == 1 ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-remove'}}"></span></td>
                    <td><span class="{{$cnt->silver == 1 ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-remove'}}"></span></td>
                    <td><span class="{{$cnt->gold == 1 ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-remove'}}"></span></td>
                    <td class="text-center">
                        <a href="{{url('admin/PackageOptions/'.$cnt->id.'/edit')}}" title="Edit Package Option" class="edit_info">
                            <span class="glyphicon glyphicon-pencil"></span></a> &nbsp;

                        
                        <?php if($cnt->active){ ?>
                            <a href="{{url('admin/PackageOptions/status/'.$cnt->id)}}/0" title="Deative">
                                <span class="glyphicon glyphicon-remove mr5"></span>
                            </a> &nbsp;
                        <?php }else{?>
                            <a href="{{url('admin/PackageOptions/status/'.$cnt->id)}}/1" title="Active">
                                <span class="glyphicon glyphicon-ok mr5"></span>
                            </a> &nbsp;                             
                        <?php } ?>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $packageOptions->links() !!}
</div>

@endsection
@section('scripts')

<script>
    $(document).ready(function() {
        //$('a.main_image').nyroModal({width:350, height:150});
        //$('a.edit_info').nyroModal({width:600, height:400});
    });
</script>

@endsection
