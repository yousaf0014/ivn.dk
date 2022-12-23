@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>User Deleting Requests</h3></div>
                <div class="pull-right" style="padding-top:20px;color:black">
                <!-- <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/reports/')}}">
                    <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
                </form> -->
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
        <tr>        
            <th class="text-center" width="5%">#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Package</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        
        <?php 
        $page = $users->lastPage();
        $counter = ($users->currentPage()-1) * $users->perPage();
        $total = count($users);
        ?>
        @foreach ($users as $user)
            <?php $counter++;?>
            <tr>
                <td>{{$counter}}</td>
                <td>
                    <img width="50" class="img-circle" src="{{ asset('uploads/profile/' . $user->profile_image) }}" alt="{{ $user->first_name }} {{ $user->last_name }}">
                </td>
                <td>
                    {{ $user->first_name }} {{ $user->last_name }}                                  
                </td>
                <td>
                    {{ $user->email }}

                </td>
                <td>
                    {{ $user->user_type }}

                </td>
                <td>
                    {{ $user->user_subscription }}
                </td>
                
                <td>{{ $user->created_at->format('d F Y') }}</td>
                <td>{{ $user->updated_at->format('d F Y') }}</td>
                <td>{{$user->status}}</td>
                <td>
                    {!! Form::open(array('url' => 'admin/deleteRequestedUser/'.$user->id,'id'=>'delete_'.$user->id,'class' => 'pull-right')) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::close() !!}

                    <a onclick="show_alert('{{$user->id}}')" href="javascript:;" title="Delete">
                        <span class="glyphicon glyphicon-trash mr5"></span>
                    </a> &nbsp;
                </td>
            </tr>
        @endforeach
    </table>
    {!! $users->links() !!}
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
function show_alert(id) {
    if(confirm('Are you sure? you want to delete.')){
        $('#delete_'+id).submit();
    }else{
        return false;
    }
}

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
</script>
@endsection