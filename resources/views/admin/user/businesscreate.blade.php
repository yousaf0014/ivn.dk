@extends('layouts.admin.app')
@section('content')
	<div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Edit Business
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/business')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" style="margin-right:5px" class="btn btn-warning pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>
       	<div class="panel-body">
            <ol class="breadcrumb">         
                <li> <a href="{{url('admin/business')}}">Home</a></li>
	            <li class="active"><strong>Edit Business</strong> </li>
            </ol>
            <form class="form-horizontal" id="addForm" method="post" enctype="multipart/form-data" action="{{ url('admin/business/save') }}">
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
				    <label class="col-md-2" for="profilePic">Profile Pic</label>
				    <div class="col-md-10">
				        <div id="profile-pic">
				            <img width="75" alt="No Image" src="">
				        </div>
				        <input type="file" name="profile_image" id="profilePic" accept='image/*'>
				    </div>
				</div>


				<div class="form-group">
				    <label class="col-md-2" for="profilePic">Page Header</label>
				    <div class="col-md-10">
				        <div id="header-pic">
				            <img width="75" alt="No Image" src="">
				        </div>
				        <input type="file" name="header_image" id="headerPic" accept='image/*'>
				    </div>
				</div>				

				<div class="form-group">
				    <label class="col-md-2" for="business_page_title">Business Page Title</label>
				    <div class="col-md-10">
				        <input type="text" name="business_page_title" id="business_page_title" class="form-control" value="">
				    </div>
				</div>

				<div class="form-group">
				    <label class="col-md-2" for="description">Description</label>
				    <div class="col-md-10">
				    	{!! Form::textarea('description', Input::old('description'), array('id'=>'editor','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
        				<textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
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

				<div class="form-group">
				    <label class="col-lg-2">Company name:</label>
				    <div class="col-lg-10">                         
				        <input type="text" name="c_name" value="<?php echo !empty($company) ? $company->name:'';?>" class="form-control">
				    </div>
				</div>

				<div class="form-group">
				    <label class="col-lg-2">Company Type:</label>
				    <div class="col-lg-10">                         
				        <select name="c_type" id="" class="form-control">
				            <option value=""></option>
				            <option value="I/S" <?php echo !empty($company) && $company->type == 'I/S' ? 'selected="selected"':'';?>>I/S</option>
				            <option value="IVS" <?php echo !empty($company) && $company->type == 'IVS' ? 'selected="selected"':'';?>>IVS</option>
				            <option value="ApS" <?php echo !empty($company) && $company->type == 'ApS' ? 'selected="selected"':'';?>>ApS</option>
				            <option value="A/S" <?php echo !empty($company) && $company->type == 'A/S' ? 'selected="selected"':'';?>>A/S</option>
				        </select>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2">Company CVR:</label>
				    <div class="col-lg-10">                         
				        <input type="text" name="c_cvr" value="<?php echo  !empty($company)  ? $company->cvr:'';?>" class="form-control">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2">Adresse 1:</label>
				    <div class="col-lg-4">                         
				        <input type="text" name="c_address" value="<?php echo  !empty($company)  ? $company->address1:'';?>" class="form-control">
				    </div>
				    <label class="col-lg-2">Hus nr.</label>
				    <div class="col-lg-4">                         
				        <input type="text" name="c_house_no" value="<?php echo  !empty($company)  ? $company->house_no:'';?>" class="form-control">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2">Company Adresse 2:</label>
				    <div class="col-lg-10">                         
				        <input type="text" name="c_adress2" value="<?php echo  !empty($company)  ? $company->address2:'';?>" class="form-control">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2">Post nr.</label>
				    <div class="col-lg-4">                         
				        <input type="text" name="c_zip" value="<?php echo  !empty($company) ? $company->zip:'';?>" class="form-control">
				    </div>
				    <label class="col-lg-2">By:</label>
				    <div class="col-lg-4">
				        <input type="text" name="c_city" value="<?php echo  !empty($company) ? $company->city:'';?>" class="form-control">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2">E-mail:</label>
				    <div class="col-lg-10">                         
				        <input type="email" name="c_email" value="<?php echo  !empty($company) ? $company->email:'';?>" class="form-control">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2">WWW:</label>
				    <div class="col-lg-10">                         
				        <input type="text" name="c_url" value="<?php echo  !empty($company) ? $company->url:'';?>" class="form-control">
				    </div>
				</div>                  
				<div class="form-group">
				    <label class="col-lg-2">Tilknytning:</label>
				    <div class="col-lg-10">                         
				        <select name="c_Entrepreneurial_status" id="" class="form-control">
				            <option value=""></option>
				            <option value="entrepreneur" <?php echo !empty($company) && $company->entrepreneurial_status == 'entrepreneur' ? 'selected="selected"':'';?>>Jeg er iværksætter</option>
				            <option value="entrepreneur_soon" <?php echo !empty($company) && $company->entrepreneurial_status == 'entrepreneur_soon' ? 'selected="selected"':'';?>>Jeg bliver snart iværksætter</option>
				            <option value="interested_entrepreneurship" <?php echo !empty($company) && $company->entrepreneurial_status == 'interested_entrepreneurship' ? 'selected="selected"':'';?>>Jeg er interesseret i iværksætteri</option>
				        </select>
				    </div>
				</div>                  
				<div class="form-group">
				    <label class="col-lg-2">Ugentligt timetal:</label>
				    <div class="col-lg-5">                         
				        <input type="radio" name="c_job_type" id="Fuldtid" <?php echo  !empty($company) && $company->job_type == 'full_time'? 'checked="checked"':'';?>  value="full_time" class="radio-button" />&nbsp;Fuldtid
				    </div>
				    <div class="col-lg-5">                         
				        <input type="radio" name="c_job_type" id="Deltid" <?php echo  !empty($company) && $company->job_type == 'part_time'? 'checked="checked"':'';?> value="part_time" class="radio-button" />&nbsp;Deltid
				    </div>
				</div>                  


				<div class="hr-line-dashed"></div>
				<div class="form-group">
				    <div class="col-md-10 col-md-offset-2">
				        <button class="btn btn-primary pull-left" onclick="submitMe()" type="button">Submit</button>
				    </div>
				</div>
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
	        $('#addForm').submit();
	    }
	    $(document).ready(function(){
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
	            }
	        };
	            
	        $('#addForm').validate( options );

	        $('#text_content').Editor();
	        //$('#text_content').Editor('setText',[$('#editor').text()]);    	
	        $.ajaxSetup({
	           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	        });

        	
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