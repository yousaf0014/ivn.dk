@extends('layouts.default.app')
<!-- if there are creation errors, they will show here -->
@section('content')
<div class="edit-profile-box form-elments bg-white">
	<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 no-margin">
					{{ Html::ul($errors->all()) }}
            		{!! Form::open(array('url' => 'editProfile','id'=>'add_content','name'=>'add_content','files'=>'true','class'=>'form-horizontal')) !!}
						<div class="profile-image">
							<div class="img">
								<img src="{{ asset('uploads/profile/' . $user->profile_image) }}" id="profile_img" alt="img">
								<div class="profile-image-changer">
									<input type="file" name="profile_image" id="profilePic" accept='image/*'>
									<img src="{{asset('images/icons/img-plus-white.png')}}" alt="plus icon" class="imgPlus">
								</div>							
							</div>
						</div>
						<div class="form-field" id="img_hidden" style="display:none">
							<div class="img-container" style="width:500px;">
					        	<img id="crop" src="{{ asset('uploads/profile/' . $user->profile_image) }}" />
					        </div>
					        <div class="popup-buttons">
								<a href="javascript:;" onclick="closeCroping()" class="btn btn-primary btn-popup min-width-500">OK</a>
							</div>
						</div>
						<div class="form-field">
							<label>Profilbillede</label>
							<div id="docs-preview" style="display:none">
								<div class="img-preview preview-lg"></div>
							</div>
							<div class="clear-fix"></div>
							
						</div>
						<div class="form-field" id="editImag" style="display:none">
							<label>&nbsp;</label>
							<div>
								<a href="javascript:;" onclick="reCrope()" style="color:blue;text-decoration:underline">Tilpas</a>
							</div>							
						</div>
						<div class="form-field">
							<label>Fornavn:</label>
							<input type="text" name="first_name" value="{{$user->first_name}}" class="form-control">
							
						</div>

						<div class="form-field">
							<label>Efternavn:</label>
							<input type="text" name="last_name" value="{{$user->last_name}}" class="form-control">
						</div>

						<div class="form-field">
							<label>E-mail:</label>
							<input type="email" name="email" value="{{$user->email}}" class="form-control">
						</div>

						<div class="form-field">
							<label>Adgangskode:</label>
							<input type="password" name="password" value="" class="form-control">
						</div>

						<div class="form-field">
							<label>Bekræft adgangskode:</label>
							<input type="password" id="password" value="" class="form-control">
						</div>

						<div class="form-field">
							<div class="row">
								<div class="col-xs-8 col-sm-9">
									<label>Adresse 1:</label>
									<input type="text" name="address" value="{{$user->address}}" class="form-control">
								</div>
								<div class="col-xs-4 col-sm-3">
									<label>Hus nr.</label>
									<input type="text" name="housenumber" value="{{$user->housenumber}}" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-field">
							<label>Adresse 2:</label>
							<input type="text" name="address2" value="{{$user->address2}}" class="form-control">
						</div>

						<div class="form-field">
							<div class="row">
								<div class="col-xs-4 col-sm-3">
									<label>Post nr.</label>
									<input type="text" name="zipcode" value="{{$user->zipcode}}" class="form-control">
								</div>
								<div class="col-xs-8 col-sm-9">
									<label>By:</label>
									<input type="text" name="city" value="{{$user->city}}" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-field">
							<label>Telefonnummer:</label>
							<input type="text" name="mobile" value="{{$user->mobile}}" class="form-control">
						</div>

						<div class="form-field">
							<label>Land:</label>
							<select class="form-control" name="country">
								<option value=""></option>
								<?php foreach($countries as $country){ ?>
									<option <?php echo $country->id == $user->country ? 'selected="selected"':'';?> value="<?php echo  $country->id; ?>"><?php echo  $country->name; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-field">
							<div class="row">
								<div class="col-xs-12 col-sm-3">
									<?php $dobArr = explode('-', $user->date_of_birth);
									?>
									<label>Dag:</label>
									<select class="form-control" name="day">
										<option value=""></option>
										<?php for($i=0; $i <= 31; $i++){?>
											<option <?php echo !empty($dobArr[2]) && $dobArr[2] == $i ? 'selected="selected"':'';?> value="<?php echo $i ;?>"><?php echo $i ;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-xs-12 col-sm-6">
									<label>Måned:</label>
									<select class="form-control" name="month">
										<option value=""></option>
										<?php  $monthList = array(1=>'Januar', 2=>'Februar',3=>'Marts',4=>'April',5=>'Maj',6=>'Juni',
												7=>'Juli',8=>'August',9=>'September',10=>'Oktober',11=>'November',12=>'December'); 
											foreach($monthList as $id=>$month){ ?>
												<option <?php echo !empty($dobArr[1]) && $dobArr[1] == $id ? 'selected="selected"':'';?> value="<?php echo $id;?>"><?php echo $month ;?></option>
											<?php } ?>
									</select>
								</div>
								<div class="col-xs-12 col-sm-3">
									<label>År:</label>
									<select class="form-control" name="year">
										<option value=""></option>
										
										<?php for($i=1950; $i <= date('Y'); $i++){?>
											<option <?php echo !empty($dobArr[0]) && $dobArr[0] == $i ? 'selected="selected"':'';?> value="<?php echo $i ;?>"><?php echo $i ;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="form-field">
							<label>Køn:</label>
							<div class="centered-align">
								<div class="fancy-radio-button">
									<input type="radio" name="gender" <?php echo $user->gender == 'male' ? 'checked="checked"':'';?> id="Mand" value="male" class="radio-button" />
									<label for="Mand" class="radio-button-click-target">
										<span class="radio-button-circle"></span>
										Mand
									</label>
								</div>
								<div class="fancy-radio-button">
									<input type="radio" name="gender" <?php echo $user->gender == 'female' ? 'checked="checked"':'';?> value="female" id="Kvinde" class="radio-button" />
									<label for="Kvinde" class="radio-button-click-target">
										<span class="radio-button-circle"></span>
										Kvinde
									</label>
								</div>
							</div>
						</div>

						<div class="form-field">
							<label>Titel:</label>
							<input type="text" name="job_title" value="<?php echo $user->job_title;?>" class="form-control">
						</div>

						<div class="form-field">
							<label>Primær beskæftigelse:</label>
							<select name="primary_occupation" id="" class="form-control">
								<option value=""></option>
								<option <?php echo $user->primary_occupation == 'selfemployed' ? 'selected="selected"':'';?> value="selfemployed">Selvstændig</option>
								<option <?php echo $user->primary_occupation == 'student' ? 'selected="selected"':'';?> value="student">Studerende</option>
								<option <?php echo $user->primary_occupation == 'employed' ? 'selected="selected"':'';?> value="employed">Lønmodtager</option>
							</select>
						</div>

						<div class="form-field">
							<label>Tilknytning:</label>
							<select name="entrepreneurial_status" id="" class="form-control">
								<option value=""></option>
								<option <?php echo $user->entrepreneurial_status == 'entrepreneur' ? 'selected="selected"':'';?> value="entrepreneur">Jeg er iværksætter</option>
								<option <?php echo $user->entrepreneurial_status == 'entrepreneur_soon' ? 'selected="selected"':'';?> value="entrepreneur_soon">Jeg bliver snart iværksætter</option>
								<option <?php echo $user->entrepreneurial_status == 'interested_entrepreneurship' ? 'selected="selected"':'';?> value="interested_entrepreneurship">Jeg er interesseret i iværksætteri</option>
							</select>
						</div>

						<div class="form-field">
							<div class="centered-align">
								<h3>Min virksomhed</h3>
							</div>
						</div>
						<div class="form-field">
							<label>Firmanavn:</label>
							<input type="text" name="c_name" value="<?php echo !empty($company) ? $company->name:'';?>" class="form-control">
						</div>

						<div class="form-field">
							<label>Selskabsform:</label>
							<select name="c_type" id="" class="form-control">
								<option value=""></option>
								<option value="I/S" <?php echo !empty($company) && $company->type == 'I/S' ? 'selected="selected"':'';?>>I/S</option>
								<option value="IVS" <?php echo !empty($company) && $company->type == 'IVS' ? 'selected="selected"':'';?>>IVS</option>
								<option value="ApS" <?php echo !empty($company) && $company->type == 'ApS' ? 'selected="selected"':'';?>>ApS</option>
								<option value="A/S" <?php echo !empty($company) && $company->type == 'A/S' ? 'selected="selected"':'';?>>A/S</option>
							</select>
						</div>

						<div class="form-field">
							<label>CVR:</label>
							<input type="text" name="c_cvr" value="<?php echo  !empty($company)  ? $company->cvr:'';?>" class="form-control">
						</div>

						<div class="form-field">
							<div class="row">
								<div class="col-xs-8 col-sm-9">
									<label>Adresse 1:</label>
									<input type="text" name="c_address" value="<?php echo  !empty($company)  ? $company->address1:'';?>" class="form-control">
								</div>
								<div class="col-xs-4 col-sm-3">
									<label>Hus nr.</label>
									<input type="text" name="c_house_no" value="<?php echo  !empty($company)  ? $company->house_no:'';?>" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-field">
							<label>Adresse 2:</label>
							<input type="text" name="c_adress2" value="<?php echo  !empty($company)  ? $company->address2:'';?>" class="form-control">
						</div>

						<div class="form-field">
							<div class="row">
								<div class="col-xs-4 col-sm-3">
									<label>Post nr.</label>
									<input type="text" name="c_zip" value="<?php echo  !empty($company) ? $company->zip:'';?>" class="form-control">
								</div>
								<div class="col-xs-8 col-sm-9">
									<label>By:</label>
									<input type="text" name="c_city" value="<?php echo  !empty($company) ? $company->city:'';?>" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-field">
							<label>E-mail:</label>
							<input type="email" name="c_email" value="<?php echo  !empty($company) ? $company->email:'';?>" class="form-control">
						</div>

						<div class="form-field">
							<label>WWW:</label>
							<input type="text" name="c_url" value="<?php echo  !empty($company) ? $company->url:'';?>" class="form-control">
						</div>

						<div class="form-field">
							<label>Tilknytning:</label>
							<select name="c_Entrepreneurial_status" id="" class="form-control">
								<option value=""></option>
								<option value="entrepreneur" <?php echo !empty($company) && $company->entrepreneurial_status == 'entrepreneur' ? 'selected="selected"':'';?>>Jeg er iværksætter</option>
								<option value="entrepreneur_soon" <?php echo !empty($company) && $company->entrepreneurial_status == 'entrepreneur_soon' ? 'selected="selected"':'';?>>Jeg bliver snart iværksætter</option>
								<option value="interested_entrepreneurship" <?php echo !empty($company) && $company->entrepreneurial_status == 'interested_entrepreneurship' ? 'selected="selected"':'';?>>Jeg er interesseret i iværksætteri</option>
							</select>
						</div>

						<div class="form-field">
							<label>Ugentligt timetal:</label>
							<div class="centered-align">
								<div class="centered-align">
									<div class="fancy-radio-button">
										<input type="radio" name="c_job_type" required="true" id="Fuldtid" <?php echo  !empty($company) && $company->job_type == 'full_time'? 'checked="checked"':'';?>  value="full_time" class="radio-button" />
										<label for="Fuldtid" class="radio-button-click-target">
											<span class="radio-button-circle"></span>
											Fuldtid
										</label>
									</div>
									<div class="fancy-radio-button">
										<input type="radio" name="c_job_type" required="true" id="Deltid" <?php echo  !empty($company) && $company->job_type == 'part_time'? 'checked="checked"':'';?> value="part_time" class="radio-button" />
										<label for="Deltid" class="radio-button-click-target">
											<span class="radio-button-circle"></span>
											Deltid
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="form-btn">
							<input id="dataWidth" name="width" type="hidden">
							<input id="dataHeight" name="height" type="hidden">
							<input id="dataX" name="x" type="hidden">
							<input id="dataY" name="y" type="hidden">
							<input id="dataRotate" name="rotate" type="hidden">
							<input id="dataScaleX" name="scalex" type="hidden">
							<input id="dataScaleY" name="scaley" type="hidden">
							<input type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','EditProfileSave')" name="" value="Gem" class="btn btn-primary">
						</div>

						
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
<!-- Modal -->
<div class="modal fade" id="CropImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="text-align:center;" >
            	<div class="clearfix"></div>
            	<div class="popup-buttons">
					<a href="javascript:;" onclick="closeCroping()" class="btn btn-primary btn-popup min-width-500">Done</a>
				</div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<link href="{{asset('css/cropper.css?v=1')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/cropper_image.css?v=1')}}" rel="stylesheet" type="text/css">
<script src="{{asset('js/cropper.js?v=1')}}" ></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript">
	var console = window.console || { log: function () {} };
	var URL = window.URL || window.webkitURL;
	var $image = $('#crop');
	var $dataX = $('#dataX');
	  var $dataY = $('#dataY');
	  var $dataHeight = $('#dataHeight');
	  var $dataWidth = $('#dataWidth');
	  var $dataRotate = $('#dataRotate');
	  var $dataScaleX = $('#dataScaleX');
	  var $dataScaleY = $('#dataScaleY');
	   var options = {
        aspectRatio: 1 /1,
        preview: '.img-preview',
        crop: function (e) {
          $dataX.val(Math.round(e.detail.x));
          $dataY.val(Math.round(e.detail.y));
          $dataHeight.val(Math.round(e.detail.height));
          $dataWidth.val(Math.round(e.detail.width));
          $dataRotate.val(e.detail.rotate);
          $dataScaleX.val(e.detail.scaleX);
          $dataScaleY.val(e.detail.scaleY);
        }
      };
	var originalImageURL = $image.attr('src');
	var uploadedImageURL;

	$(document.body).on('keydown', function (e) {
	    if (!$image.data('cropper') || this.scrollTop > 300) {
	      return;
	    }

	    switch (e.which) {
	      case 37:
	        e.preventDefault();
	        $image.cropper('move', -1, 0);
	        break;

	      case 38:
	        e.preventDefault();
	        $image.cropper('move', 0, -1);
	        break;

	      case 39:
	        e.preventDefault();
	        $image.cropper('move', 1, 0);
	        break;

	      case 40:
	        e.preventDefault();
	        $image.cropper('move', 0, 1);
	        break;
	    }

	  });

	function closeCroping(){
		$('#docs-preview').hide();
		$image.cropper('destroy');
		$('#img_hidden').hide();
	}

	function reCrope(){
		$('#docs-preview').show();
		$image.cropper('destroy');
		$('#img_hidden').show();	
		$('.imgChoosedRemover1').show();
        //$("#CropImage").modal('show');
        $('#docs-preview').show();
        $('#img_hidden').show();
        var options = {
        aspectRatio:1/1,
        preview: '.img-preview',
        crop: function (e) {
	          $dataX.val(Math.round(e.detail.x));
	          $dataY.val(Math.round(e.detail.y));
	          $dataHeight.val(Math.round(e.detail.height));
	          $dataWidth.val(Math.round(e.detail.width));
	          $dataRotate.val(e.detail.rotate);
	          $dataScaleX.val(e.detail.scaleX);
	          $dataScaleY.val(e.detail.scaleY);
	        }
	      };
	    $image = $('#crop');
        $image.cropper(options);
	}

    function imageIsLoaded(e) {
    	$('#editImag').show();
        $('#profile_img').attr('src', e.target.result);
        $('.imgPlus').hide();
        $('.imgChoosedRemover1').show();
        //$("#CropImage").modal('show');
        $('#docs-preview').show();
        $('#img_hidden').show();
        var options = {
        aspectRatio:1/1,
        preview: '.img-preview',
        crop: function (e) {
	          $dataX.val(Math.round(e.detail.x));
	          $dataY.val(Math.round(e.detail.y));
	          $dataHeight.val(Math.round(e.detail.height));
	          $dataWidth.val(Math.round(e.detail.width));
	          $dataRotate.val(e.detail.rotate);
	          $dataScaleX.val(e.detail.scaleX);
	          $dataScaleY.val(e.detail.scaleY);
	        }
	      };
	    $image = $('#crop');
        $image.cropper('destroy').attr('src', e.target.result).cropper(options);
    };
   
			/*$(window).bind('beforeunload', function() {
	    		if($('form #add_content').serialize()!=$('form #add_content').data('serialize')){
			    	return confirm("{{cmskey('leave_without_save')}}");	    	
			    }else e=null; // i.e; if form state change show warning box, else don't show it.
	    	} ); */
	    	
    
	    $(document).ready(function(){	 
	    	$("#profilePic").change(function () {
	            if (this.files && this.files[0]) {
	                var reader = new FileReader();
	                reader.onload = imageIsLoaded;
	                reader.readAsDataURL(this.files[0]);
	            }
	        });

	    	$('form #add_content').data('serialize',$('#add_content').serialize());
	    	
        options = {
                rules: {
                    "first_name": "required",
                    "last_name": "required",
                    "email"		:{"required":true,'email':true},
                    "password_again": {
				      equalTo: "#password",
				      'minlength':7
				    },
				    "confirm":'required',
				    'c_job_type':'required'
                },
                messages: {
                    "first_name": "Please enter First name",
                    "last_name": "Please enter Last name",
                    "email"		:{ "required" : "Please enter Email" , 'email' : 'Please enter a valid email', },
                    "password_again": {
				      equalTo: "Password does not matched",
				      'minlength':"Minimum length is 7 characters"
				    },
				    "confirm":'Please agree to term and conditions to continue',
				    'c_job_type':"Please Choose"
                }
            }
            $('#add_content').validate( options );
	    });
	</script>
@endsection