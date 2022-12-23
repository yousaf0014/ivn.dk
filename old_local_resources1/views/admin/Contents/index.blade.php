@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Content Management</h3></div>
                <div class="pull-right" style="color:black">
                    <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/Contents')}}">
                        <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
                        <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                        <a href="{{url('admin/Contents/create/')}}" class="btn btn-warning btn-sm">Add Content</a>
                        <a href="{{url('admin/Contents/reorder')}}" class="btn btn-success btn-sm">Reorder</a>                
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>



        <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
            <tr>        
                <th class="text-center" width="5%">#</th>
                <th class="text-center" width="5%">SHOW</th>
                <th class="text-center" width="5%">Slider</th>
                <th class="text-center">Link Title</th>
                <th class="text-center">Business Name</th>
                <th class="text-center" width="20%">IMAGE</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
            
            <?php 
            $page = $contents->lastPage();
            $counter = ($contents->currentPage()-1) * $contents->perPage();
            $total = count($contents);
            ?>
            @foreach ($contents as $cnt)
                <?php $counter++; ?>
                <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td class="text-center">
                        <input type="checkbox" value="{{$cnt->id}}"  <?php echo $cnt->show_image == 1 ? 'checked="checked"' : ''?> onclick="show_image(this);" />
                    </td>
                    <td class="text-center">
                        <input type="checkbox" value="{{$cnt->id}}" <?php echo $cnt->show_gallery == 1 ? 'checked="checked"' : ''?> onclick="show_gallery(this);" />
                    </td>

                    <td>{{$cnt->link_title}}</td>
                    <td>{{!empty($bustinessList[$cnt->parent_id]) ? $bustinessList[$cnt->parent_id]:''}}</td>

                    <td class="text-center">
                        @if (!empty($cnt->image_path))
                            <img src="{{asset('user_images/thumb_'.$cnt->image_path)}}" width="150"  />
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-center">
                        <a data-target-url="{{url('admin/Contents/editInfo',$cnt->id)}}" href="javascript:;" data-toggle="modal" data-target-id="{{$cnt->id}}" data-target="#myModal" class="glyphicon glyphicon-edit edit_info" title="Edit Image Info"></a> &nbsp;

                        <a title="Upload Image" data-target-url="{{url('admin/Contents/addImage',$cnt->id)}}" href="javascript:;" class="main_image" data-toggle="modal" data-target-id="{{$cnt->id}}" data-target="#myModal">
                            <span class="glyphicon glyphicon-picture"></span></a>  &nbsp;

                        <a href="{{url('admin/Contents/'.$cnt->id.'/edit')}}" title="Edit Content" class="edit_info">
                            <span class="glyphicon glyphicon-pencil"></span></a> &nbsp;

                        {!! Form::open(array('url' => 'admin/Contents/' . $cnt->id ,'id'=>'delete_'.$cnt->id,'class' => 'pull-right')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::close() !!}


                        <a onclick="show_alert('{{$cnt->id}}')" href="javascript:;" title="Delete">
                            <span class="glyphicon glyphicon-trash mr5"></span>
                        </a> &nbsp;

                        <a href="{{url('admin/ContentImages',$cnt->id)}}" title="Gallery">
                            <span class="glyphicon glyphicon-camera"></span>
                        </a> &nbsp;                
                        
                        <a title="Preview" href="{{url('admin/Contents',$cnt->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                        &nbsp;
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $contents->links() !!}
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

    function show_image(elem) {
        var photo_id = $(elem).val();
        var action = ($(elem).is(":checked")) ? 1 : 0;
        $.ajax({
          url: "{{url('admin/Contents/showImage')}}"+'/' + photo_id + '/' + action,
          type: "post",
          data: {},
          success: function(data){            
          }
        }); 
    }

    function show_gallery(elem) {
        var photo_id = $(elem).val();
        var action = ($(elem).is(":checked")) ? 1 : 0;
        $.ajax({
          url: "{{url('admin/Contents/showgallery')}}"+'/' + photo_id + '/' + action,
          type: "post",
          data: {},
          success: function(data){           
          }
        });
    }
</script>

@endsection