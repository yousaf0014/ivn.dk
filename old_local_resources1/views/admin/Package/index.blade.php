@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Package Management</h3></div>
                <div class="pull-right" style="color:black">
                    <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/Package')}}">
                        <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
                        <select name="active" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
                            <option value="-1" @if($active == -1) {{ 'selected="selected"' }} @endif>All</option>
                            <option value="0" @if($active == 0) {{ 'selected="selected"' }} @endif>Deleted</option>
                            <option value="1" @if($active == 1) {{ 'selected="selected"' }} @endif>Active</option>
                        </select>
                        <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                        <a href="{{url('admin/Package/create/')}}" class="btn btn-warning btn-sm">Add Package</a>                
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
            <tr>        
                <th class="text-center" width="5%">#</th>
                <th class="text-center" width="5%">Title</th>
                <th class="text-center" width="5%">Price</th>
                <th class="text-center" width="5%">Price Inc.Vat</th>
                <th class="text-center">Reepay Plan ID</th>
                <th class="text-center">Description</th>
                <th class="text-center" width="20%">IMAGE</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
            
            <?php 
            $page = $packages->lastPage();
            $counter = ($packages->currentPage()-1) * $packages->perPage();
            $total = count($packages);
            ?>
            @foreach ($packages as $cnt)
                <?php $counter++; ?>
                <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td>{{$cnt->title}}</td>
                    <td>{{$cnt->price}}</td>
                    <td>{{$cnt->price_inc_vat}}</td>
                    <td>{{$cnt->reepay_plan_id}}</td>
                    <td><?php echo shortString($cnt->details,50); ?></td>
                    
                    <td class="text-center">
                        @if (!empty($cnt->image_path))
                            <img src="{{asset('uploads/package/'.$cnt->image_path)}}" width="150"  />
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-center">
                        <a title="Upload Image" data-target-url="{{url('admin/Package/addImage',$cnt->id)}}" href="javascript:;" class="main_image" data-toggle="modal" data-target-id="{{$cnt->id}}" data-target="#myModal">
                            <span class="glyphicon glyphicon-picture"></span></a>  &nbsp;

                        <a href="{{url('admin/Package/'.$cnt->id.'/edit')}}" title="Edit Package" class="edit_info">
                            <span class="glyphicon glyphicon-pencil"></span></a> &nbsp;

                        
                        {!! Form::open(array('url' => 'admin/Package/' . $cnt->id ,'id'=>'delete_'.$cnt->id,'class' => 'pull-right')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::close() !!}


                       <!-- <a onclick="show_alert('{{$cnt->id}}')" href="javascript:;" title="Delete">
                            <span class="glyphicon glyphicon-trash mr5"></span>
                        </a> &nbsp;
                        
                        <?php if($cnt->active){ ?>
                            <a href="{{url('admin/Package/status/'.$cnt->id)}}/0" title="Deative">
                                <span class="glyphicon glyphicon-remove mr5"></span>
                            </a> &nbsp;
                        <?php }else{?>
                            <a href="{{url('admin/Package/status/'.$cnt->id)}}/1" title="Active">
                                <span class="glyphicon glyphicon-ok mr5"></span>
                            </a> &nbsp;                             
                        <?php } ?>  -->

                        <a title="Preview" href="{{url('admin/Package',$cnt->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                        &nbsp;
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $packages->links() !!}
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
</script>

@endsection
