@extends('layouts.admin.app')
@section('content')
	<div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Edit User
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/business')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" class="btn btn-warning pull-right btn-sm mt5 mr10" style="margin-right:5px;">Save</a>    
            <div class="clearfix"></div>
        </div>
       	<div class="panel-body">
            <ol class="breadcrumb">         
                <li> <a href="{{url('admin/profile')}}">Home</a></li>
	            <li class="active"><strong>Edit User</strong> </li>
            </ol>
        	<form class="form-horizontal" id="editUser" method="post" enctype="multipart/form-data" action="{{ url('admin/business/store') }}">
				<input type="hidden" id="uid" name="id" value="{{ $user->id }}">
				@include('admin.user.businessformhtml');
				{{ csrf_field() }}							
			</form>
		</div>
	</div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="{{asset('css/editor.css?v=1')}}" />
@endsection
@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/editor1.js')}}"></script>
	<script type="text/javascript">
	    function submitMe(){
	        $('#editor').text($('#text_content').Editor("getText"));  
	        $('#editUser').submit();
	    }
	    $(document).ready(function(){
	        $('#text_content').Editor();
	        $('#text_content').Editor('setText',[$('#editor').text()]);    	

	        options = {
	                rules: {
	                    "first_name": "required",
	                    "last_name": "required",
	                    "email":{"email":true,"required":true}
	                },
	                messages: {
	                    "title": "Please enter Content Page title",
	                    "link_title": "Please enter Content Link title",
	                    "email":{email:"Please provide a valid Email",required:"Email is required"}
	                }
	            };
	            
	            $('#editUser').validate( options );
	    });

    </script>
    	 
@endsection