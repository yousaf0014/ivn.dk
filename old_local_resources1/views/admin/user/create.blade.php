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
            <a href="javascript:;" onclick="submitMe()" style="margin-right:5px" class="btn btn-warning pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>
       	<div class="panel-body">
            <ol class="breadcrumb">         
                <li> <a href="{{url('admin/profile')}}">Home</a></li>
	            <li class="active"><strong>Edit User</strong> </li>
            </ol>
            <form class="form-horizontal" id="addForm" method="post" enctype="multipart/form-data" action="{{ url('admin/user/store') }}">
				{{ csrf_field() }}							
				<div class="form-group">
				    <label class="col-md-2" for="fName">Name</label>
				    <div class="col-md-5">
				        <input type="text" name="first_name" id="first_name" class="form-control" value="">
				        <p class="help-block">First Name</p>
				    </div>
				    <div class="col-md-5">
				        <input type="text" name="last_name" id="lName" class="form-control" value="">
				        <p class="help-block">Last Name</p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="username">Email</label>
				    <div class="col-md-10">
				        <input type="text" name="email"  id="email" class="form-control" value="">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="country">Country</label>
				    <div class="col-md-10">
				        <select name="country" class="form-control" id="country">
							<option value="">--Select Country--</option>
							<?php 
							foreach ($countries as $value){	?>
								<option value="{{$value->id}}">{{$value->name}}</option>
							<?php }?>
						</select>	
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="city">City</label>
				    <div class="col-md-10">
				        <input type="text" name="city" id="city" class="form-control" value="">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="postCode">Zip Code</label>
				    <div class="col-md-10">
				        <input type="text" name="zipcode" id="zipCode" class="form-control" value="">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="user_type">User Type</label>
				    <div class="col-md-10">
				        <label for="admin" class="checkbox-inline">
				            <input type="radio" name="user_type"  id="admin" value="admin" class="">
				            Admin
				        </label>
				        <label for="user" class="checkbox-inline">
				            <input type="radio" name="user_type"  id="user" value="user" class="">
				            Individual
				        </label>
				        
				    </div>
				</div>

				<div class="form-group">
				    <label class="col-md-2" for="description">Description</label>
				    <div class="col-md-10">
				        <textarea name="description" id="description" class="form-control"></textarea>
				    </div>
				</div>


				<div class="form-group">
				    <label class="col-md-2" for="jobTitle">Job Title</label>
				    <div class="col-md-10">
				        <input type="text" name="job_title" id="jobTitle" class="form-control" value="">
				    </div>
				</div>

				<div class="form-group">
				    <label class="col-md-2" for="profilePic">Profile Pic</label>
				    <div class="col-md-10">
				        <div id="profile-pic">
				            <img width="75" alt="No Image" src="">
				        </div>
				        <input type="file" name="profile_image" id="profilePic" accept='image/*'>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="phone1">Contact Numbers</label>
				    <div class="col-md-5">
				        <input type="text" name="mobile" id="phone1" class="form-control" value="">
				        <p class="help-block">Phone</p>
				    </div>
				    <div class="col-md-5">
				        <input type="text" name="phone" id="phone2" class="form-control" value="">
				        <p class="help-block">Additional Phone</p>
				    </div>
				</div>

				<div class="form-group">
				    <label class="col-md-2" for="status">Status</label>
				    <div class="col-md-10">
				        <label for="status1" class="checkbox-inline">
				            <input type="radio" name="active"  id="status1" value="1" class="">
				            Active
				        </label>
				        <label for="status0" class="checkbox-inline">
				            <input type="radio" name="deactive"  id="status0" value="0" class="">
				            Inactive
				        </label>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-md-2" for="postCode">Password</label>
				    <div class="col-md-10">
				        <input type="text" name="password" id="password" class="form-control" value="">
				    </div>
				</div>

				<div class="hr-line-dashed"></div>
				<div class="form-group">
				    <div class="col-md-10 col-md-offset-2">
				        <button class="btn btn-primary pull-left" type="submit">Submit</button>
				    </div>
				</div>
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

        	var response;
	        $.validator.addMethod(
		        "uniqueEmail", 
		        function(value, element) {
		            $.ajax({
		                type: "get",
		                url: "{{url('admin/uniqueEmail')}}",
		                data: "email="+value,
		                dataType:"html",
		                success: function(msg)
		                {
		                	response =  msg;

		                }
		             });
		            return response;
		        },
		        "Email already exist"
		    );

	        options = {
	                rules: {
	                    "first_name": "required",
	                    "last_name": "required",
	                    "email":{"email":true,"required":true},
	                messages: {
	                    "title": "Please enter Content Page title",
	                    "link_title": "Please enter Content Link title",
	                    "email":{email:"Please provide a valid Email",required:"Email is required"}
	                }
	            };
	            
	            $('#addForm').validate( options );
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

		  
		  //END cover pic JS
		  
    </script>
    	 
@endsection