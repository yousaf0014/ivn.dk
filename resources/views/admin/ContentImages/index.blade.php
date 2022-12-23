@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Content( {{$content->title}} ) Images Management</h3></div>
                <div class="pull-right" style="color:black">
                    <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/ContentImages/')}}">
                        <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
                        <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                        <a href="{{url('admin/ContentImages/create',$content->id)}}" class="btn btn-warning btn-sm">Add Content Images</a>
                        <a href="{{url('admin/ContentImages/reorder',$content->id)}}" class="btn btn-warning btn-sm">Reorder</a>
                        <a class="pull-right btn btn-default btn-sm mt5" href="{{url('admin/Contents')}}">
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
                <th class="text-center" width="5%">Default</th>
                <th class="text-center">Title</th>
                <th class="text-center">Description</th>
                <th class="text-center" width="20%">IMAGE</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
            
            <?php 
            $page = $contentimages->lastPage();
            $counter = ($contentimages->currentPage()-1) * $contentimages->perPage();
            $total = count($contentimages);
            ?>
            @foreach ($contentimages as $cnt)
                <?php $counter++; ?>
                <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td class="text-center">
                        <input type="checkbox" value="{{$cnt->id}}"  <?php echo $cnt->default_photo == 1 ? 'checked="checked"' : ''?> onclick="makedefault(this);" />
                    </td>
                    <td>{{$cnt->title}}</td>
                    <td>{{$cnt->description}}</td>
                    <td class="text-center">
                        @if (!empty($cnt->path))
                            <img src="{{asset('user_images/thumb_'.$cnt->path)}}" width="150"  />
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-center">
                        <a data-target-url="{{url('admin/ContentImages/editInfo/'.$content->id,$cnt->id)}}" href="javascript:;" data-toggle="modal" data-target-id="{{$cnt->id}}" data-target="#myModal" class="glyphicon glyphicon-edit edit_info" title="Edit Image Info"></a> &nbsp;
                        {!! Form::open(array('url' => 'admin/ContentImages/' . $cnt->id ,'id'=>'delete_'.$cnt->id,'class' => 'pull-right')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::close() !!}


                        <a onclick="show_alert('{{$cnt->id}}')" href="javascript:;" title="Delete">
                            <span class="glyphicon glyphicon-trash mr5"></span>
                        </a> &nbsp;


                        <a href="javascript:;" onclick="deactivate('{{$cnt->id}}',0)" style="<?php echo $cnt->active == 1 ? '':'display:none;'?>" class="active_cls_{{$cnt->id}}" title="Gallery">
                            <span class="glyphicon glyphicon-remove mr5"></span>
                        </a> &nbsp; 

                        <a href="javascript:;" onclick="deactivate('{{$cnt->id}}',1)" style="<?php echo empty($cnt->active) ? '':'display:none;'?>" class="active_cls_{{$cnt->id}}" title="Gallery">
                            <span class="glyphicon glyphicon glyphicon-ok mr5"></span>
                        </a>
                        
                        
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $contentimages->links() !!}
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
           headers: { 'X-CSRF-Token' : $('#crf_token').val() }
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

    function deactivate(id,active) {
        $.ajax({
          url: "{{url('admin/ContentImages/showImage')}}"+'/' + id + '/' + active,
          type: "post",
          data: {},
          success: function(data){
            if(data['success']){
                $('.active_cls_'+id).toggle();
            }
          }
        }); 
    }
    function makedefault(elem) {
        var photo_id = $(elem).val();
        var action = ($(elem).is(":checked")) ? 1 : 0;
        $.ajax({
          url: "{{url('admin/ContentImages/makeDefault')}}"+'/' + photo_id + '/' + action,
          type: "post",
          data: {},
          success: function(data){           
          }
        });
    }
</script>
@endsection