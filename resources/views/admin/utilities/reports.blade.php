@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Reported Posts</h3></div>
                <div class="pull-right" style="padding-top:20px;color:black">
                <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/reports/')}}">
                    <select name="active" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
                        <option value="-1" @if($active == -1) {{ 'selected="selected"' }} @endif>All</option>
                        <option value="0" @if($active == 0) {{ 'selected="selected"' }} @endif>Deleted</option>
                        <option value="1" @if($active == 1) {{ 'selected="selected"' }} @endif>Active</option>
                    </select>
                    <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                    <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/reports')}}">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
                    </a>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
        <tr>        
             <th class="text-center" width="5%">#</th>
            <th class="text-center" >Post Details</th>
            <th class="text-center" >Post Status</th>
            <th class="text-center" >Reported By</th>
            <th class="text-center" width="15%">Actions</th>
        </tr>
        
        <?php 
        $page = $reports->lastPage();
        $counter = ($reports->currentPage()-1) * $reports->perPage();
        $total = count($reports);
        ?>
        @foreach ($reports as $cnt)
            <?php $counter++; 

            ?>
            <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td>
                        <a data-target-url="{{url('admin/reports/show',$cnt->id)}}" href="javascript:;" data-toggle="modal" data-target-id="{{$cnt->id}}" data-target="#myModal" title="Edit Image Info">
                            {{shortString($cnt->post->details,50)}}
                        </a>
                    </td>
                    <td>
                        <?php if(!empty($cnt->post->active)){ ?>
                        <a href="{{url('admin/reports/deactivePost',$cnt->post->id)}}/0">
                            <span class="glyphicon glyphicon-ok mr5"></span>
                        </a>
                        <?php }else{ ?>
                        <a href="{{url('admin/reports/deactivePost',$cnt->post->id)}}/1">                            
                            <span class="glyphicon glyphicon-remove mr5"></span>
                        </a>
                        <?php } ?>
                    </td>
                    <td>{{!empty($cnt->user) ? $cnt->user->first_name.' '.$cnt->user->last_name:''}}</td>
                    
                    <td class="text-center">
                        {!! Form::open(array('url' => 'admin/reports/' . $cnt->id ,'id'=>'delete_'.$cnt->id,'class' => 'pull-right')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::close() !!}


                        <a onclick="show_alert('{{$cnt->id}}')" href="javascript:;" title="Delete">
                            <span class="glyphicon glyphicon-trash mr5"></span>
                        </a> &nbsp;
                        <?php if($cnt->active){ ?>
                            <a href="{{url('admin/reports/status/'.$cnt->id)}}/0" title="Deactive">
                                <span class="glyphicon glyphicon-ok mr5"></span>
                            </a> &nbsp;
                        <?php }else{?>
                            <a href="{{url('admin/reports/status/'.$cnt->id)}}/1" title="active">
                                <span class="glyphicon glyphicon-remove mr5"></span>
                            </a> &nbsp;                             
                        <?php } ?>                        
                        <a title="Preview" href="{{url('admin/reports/show',$cnt->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                        &nbsp;
                    </td>
                </tr>
        @endforeach
    </table>
    {!! $reports->links() !!}
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
function hideModal(){
    jQuery('#myModal').modal('hide');
}
    $(document).ready(function(){
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $("#myModal").on("show.bs.modal", function(e) {
            url =  $(e.relatedTarget).data('target-url');
            $.get( url , function( data ) {
                $(".modal-body").html(data);
            });

        });
    });


    function show_alert(id) {
        if(confirm('Are you sure? you want to delete.')){
            $('#delete_'+id).submit();
        }else{
            return false;
        }
    }


    $(document).ready(function() {
        //$('a.main_image').nyroModal({width:350, height:150});
        //$('a.edit_info').nyroModal({width:600, height:400});
    });
</script>
@endsection