@extends('layouts.admin.app')

@section('content')

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="panel panel-primary">
    	    <div class="panel-heading">
			    <div class="col-lg-12" >
			        <div class="pull-left"><h3>Users Management</h3></div>
					    <div class="pull-right" style="color:black">
					        <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/users')}}">
					            <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
					            <select name="active" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
					            	<option value="-1" @if($active == -1) {{ 'selected="selected"' }} @endif>All</option>
					            	<option value="0" @if($active == 0) {{ 'selected="selected"' }} @endif>Deleted</option>
					            	<option value="1" @if($active == 1) {{ 'selected="selected"' }} @endif>Active</option>
					            </select>
					            <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
					            <a href="{{url('/admin/users/create/')}}" class="btn btn-warning btn-sm">Add User</a>			            
					        </form>
					    </div>
					    <div class="clearfix"></div>
			      	</div>
			      	<div class="clearfix"></div>
			    </div>
	    	</div>
	    

            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                <thead>
                  <tr>
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
                </thead>
                <tbody>
                	<?php 
				        $page = $users->lastPage();
				        $counter = ($users->currentPage()-1) * $users->perPage();
				        $total = count($users);
				        ?>
					@foreach($users as $user)
						<tr>
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
							<td>{{$user->active}}</td>
							<td>
								<a class="opreation-icon" href="{{ url('admin/user/edit/' . $user->id) }}"><i class="fa fa-pencil"></i></a>
<!-- 									<a class="opreation-icon" href="#"><i class="fa fa-trash"></i></a> -->
								<?php if($user->active){ ?>
								<a href="{{url('admin/users/delete/'.$user->id)}}/0" title="Delete">
		                            <span class="glyphicon glyphicon-remove mr5"></span>
		                        </a> &nbsp;
		                        <?php }else{?>
		                        	<a href="{{url('admin/users/delete/'.$user->id)}}/0" title="Undo Delete">
		                            	<span class="glyphicon glyphicon-ok mr5"></span>
		                        	</a> &nbsp;		                        
		                        <?php } ?>

						</td>
					</tr>
					@endforeach
				</tbody>
            </table>
            {{ $users->links() }}
        </div>
	</div>	
@endsection