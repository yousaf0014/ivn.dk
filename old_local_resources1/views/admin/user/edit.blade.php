@extends('layouts.admin.app')

@section('content')
	<div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Edit User
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/users')}}">
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
        	<form class="form-horizontal" id="editUser" method="post" enctype="multipart/form-data" action="{{ url('admin/user/save') }}">
				<input type="hidden" id="uid" name="id" value="{{ $user->id }}">
				@include('admin.user.formhtml');
				{{ csrf_field() }}							
			</form>
		</div>
	</div>
@endsection

@section('scripts')

	<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
        $(document).ready(function(){
        	$.ajaxSetup({
	           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	        });
        	
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

        //Profile Pic JS
        function handleProfileSelect(evt) {
			$('#profile-pic img').remove();
			
		    var files = evt.target.files;

		    // Loop through the FileList and render image files as thumbnails.
		    for (var i = 0, f; f = files[i]; i++) {

		      // Only process image files.
		      if (!f.type.match('image.*')) {
		        continue;
		      }

		      var reader = new FileReader();

		      // Closure to capture the file information.
		      reader.onload = (function(theFile) {
		        return function(e) {
		          // Render thumbnail.
		          var span = document.createElement('div');
		          span.className = '';
		          span.innerHTML = 
		          [
		            '<img style="width:75px;height:auto;" src="', 
		            e.target.result,
		            '" title="', escape(theFile.name), 
		            '"/>'
		          ].join('');
		          
		          document.getElementById('profile-pic').insertBefore(span, null);
		        };
		      })(f);

		      // Read in the image file as a data URL.
		      reader.readAsDataURL(f);
		    }
		  }

		  document.getElementById('profilePic').addEventListener('change', handleProfileSelect, false);
		  //END profile pic JS

		  
		  //Cover Pic JS
		  function handleCoverSelect(evt) {
			  $('#cover-pic img').remove();
				
		    var files = evt.target.files;

		    // Loop through the FileList and render image files as thumbnails.
		    for (var i = 0, f; f = files[i]; i++) {

		      // Only process image files.
		      if (!f.type.match('image.*')) {
		        continue;
		      }

		      var reader = new FileReader();

		      // Closure to capture the file information.
		      reader.onload = (function(theFile) {
		        return function(e) {
		          // Render thumbnail.
		          var span = document.createElement('div');
		          span.className = '';
		          span.innerHTML = 
		          [
		            '<img style="width:100px;height:auto;" src="', 
		            e.target.result,
		            '" title="', escape(theFile.name), 
		            '"/>'
		          ].join('');
		          
		          document.getElementById('cover-pic').insertBefore(span, null);
		        };
		      })(f);

		      // Read in the image file as a data URL.
		      reader.readAsDataURL(f);
		    }
		  }

		  document.getElementById('coverPic').addEventListener('change', handleCoverSelect, false);
		  //END cover pic JS
		  
    </script>
    	 
@endsection