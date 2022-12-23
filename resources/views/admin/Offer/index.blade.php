@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Offer Management</h3></div>
                <div class="pull-right" style="color:black">
                    <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/Offer')}}">
                        <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
                        <select name="active" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
                            <option value="-1" @if($active == -1) {{ 'selected="selected"' }} @endif>All</option>
                            <option value="0" @if($active == 0) {{ 'selected="selected"' }} @endif>Deleted</option>
                            <option value="1" @if($active == 1) {{ 'selected="selected"' }} @endif>Active</option>
                        </select>
                        <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                        <a href="{{url('admin/Offer/create/')}}" class="btn btn-warning btn-sm">Add Offer</a>                
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
                <th class="text-center">Description</th>
                <th class="text-center">Networks</th>
                <th class="text-center" width="20%">IMAGE</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
            
            <?php 
            $page = $posts['Post']->lastPage();
            $counter = ($posts['Post']->currentPage()-1) * $posts['Post']->perPage();
            $total = count($posts['Post']);
            ?>
            @foreach ($posts['Post'] as $cnt)
                <?php $counter++; ?>
                <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td>{{$cnt->title}}</td>
                    <td><?php echo shortString($cnt->details,50);?> </td>
                    <td>
                        <?php 
                        if(!$posts[$cnt->id]['networks']->isEmpty()){                            
                                foreach($posts[$cnt->id]['networks'] as $network){
                                    echo $network->title.'<br/>';
                               } 
                        } ?>
                    </td>
                    <td class="text-center">
                        @if (!empty($cnt->image_path))
                            <img src="{{asset('uploads/Offer/'.$cnt->image_path)}}" width="150"  />
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{url('admin/Offer/'.$cnt->id.'/edit')}}" title="Edit Post" class="edit_info">
                            <span class="glyphicon glyphicon-pencil"></span></a> &nbsp;

                        <?php /*
                        {!! Form::open(array('url' => 'admin/Offer/' . $cnt->id ,'id'=>'delete_'.$cnt->id,'class' => 'pull-right')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::close() !!}


                        <a onclick="show_alert('{{$cnt->id}}')" href="javascript:;" title="Delete">
                            <span class="glyphicon glyphicon-trash mr5"></span>
                        </a> &nbsp;
                        */?>
                        <?php if($cnt->active){ ?>
                            <a href="{{url('admin/Offer/delete/'.$cnt->id)}}/0" title="Delete">
                                <span class="glyphicon glyphicon-remove mr5"></span>
                            </a> &nbsp;
                        <?php }else{?>
                            <a href="{{url('admin/Offer/delete/'.$cnt->id)}}/0" title="Undo Delete">
                                <span class="glyphicon glyphicon-ok mr5"></span>
                            </a> &nbsp;                             
                        <?php } ?>

                        <a title="Preview" href="{{url('admin/Offer',$cnt->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                        &nbsp;

                        
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $posts['Post']->links() !!}
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
