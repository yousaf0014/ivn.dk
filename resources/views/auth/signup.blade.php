@extends('layouts.default.app')
<!-- if there are creation errors, they will show here -->
@section('content')
<style type="text/css">
.help-block{
    color:white;
}
.modal-content {
    border: 1px solid;
    border-radius: 0px;
}
.error{
    font-size: 12px !important;
}
</style>
<div class="content-area-full register-login-area bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="pg-heading">
					Opret profil
				</h2>
				<div class="create-profile-form">
					<div class="col-lg-10 col-md-8 col-sm-8">
						<div class="grayBox">
                            {{ Html::ul($errors->all()) }}
                			<form class="form-horizontal" id="add_user" method="post" action="{{ url('signup') }}">
                                    {{ csrf_field() }}	
    							<div class="field-box">
    								<label>Fornavn*:</label>
    								<div class="field-ctnt">
    									{!! Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) !!}
    	                                <input type="hidden" name="action" id="action" value="SIGNUP">                                
    									<div class="error-msg"></div>
    								</div>
    							</div>
    							<div class="field-box">
    								<label>Efternavn*:</label>
    								<div class="field-ctnt">
    									{!! Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) !!}									
    								</div>
    							</div>
    							<div class="field-box">
    								<label>E-mail*:</label>
    								<div class="field-ctnt">
    									{!! Form::text('email', Input::old('email'), array('id'=>'email','class' => 'form-control')) !!}									
    								</div>
    							</div>
    							<div class="field-box">
    								<label>Adgangskode*:</label>
    								<div class="field-ctnt">
    									<input type="password" name="password" id="password" value="" onkeypress="return avoidSpace(event)" class="form-control">
    									<div class="notice-field">Minimum otte tegn.</div>
    								</div>
    							</div>
    							<div class="field-box">
    								<label>Bekræft adgangskode*:</label>
    								<div class="field-ctnt">
    									<input type="password" name="confirm_password" value="" onkeypress="return avoidSpace(event)" class="form-control">
    									<div class="notice-field">Minimum otte tegn.</div>
    								</div>
    							</div>
    							 <div class="clearfix">
                                    <div class="">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="fancy-checkbox style-white">
                                                <input type="checkbox" name="confirm" value="1" class="checkbox" id="checkbox-1" onchange="changeStatus()">
                                                <label for="checkbox-1" class="checkbox-click-target" style="color:white;">
                                                    <span style="border-color:white" class="checkbox-box"></span>
                                                    Ja tak, jeg vil gerne være medlem, og accepterer samtidig IVN’s <a href="javascript:;" style="color:white !important;text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">brugerbetingelser.</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="fancy-checkbox style-white">
                                                <input type="checkbox" name=" news_letter" value="1" class="checkbox" id="checkbox-2">
                                                <label for="checkbox-2" class="checkbox-click-target" style="color:white;">
                                                    <span style="border-color:white" class="checkbox-box"></span>
                                                    Ja tak, tilmeld mig IVN’s nyhedsbreve. Jeg accepterer samtidig 
                                                    <a href="javascript:;" style="color:white !important;text-decoration: underline;" data-target="#newsletter_terms" onclick="$('#newsletter_terms').modal('show');"> betingelserne.</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="col-xs-12">
                                        <div class="col-lg-12 signup-with-fb text-center">
                                            <input type="button" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','ProfileCreation');submitUserForm()" disabled="disabled" id="submit_button" value="Opret profil" class="btn btn-priamry btnSubmt btn-inline-block btn-text-white">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="clearfix"></div>
                                <div class="or full-block form-or style-white" style="display:none;">eller</div>
                                <div class="signup-with-fb text-center" style="display:none;">
                                    <a disabled="disabled" href="#" id="fbook" data-toggle="tooltip" data-placement="top" title="Du skal acceptere brugerbetingelserns for at kunne oprette dig som bruger på IVN." class="btn btn-priamry btnSubmt btn-inline-block btn-text-white">
                                        Opret profil med Facebook
                                    </a>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="term_and_condition" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="background-color: #383838;color: #fff;font-weight: 300;">
            <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
          <div class="modal_wrapper" style="max-height: 500px;overflow: auto;">
              <div class="modal-body" style="padding:10px 15px;">
               <h2><?php echo cmskey('term_conditions_title');?></h2>
               <?php echo cmskey('term_conditions_details');?>
              </div>
         </div>
          <!--<div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>-->
        </div>
    </div>
</div>
<!-- popups -->
<div class="modal fade ivn-popups" id="newsletter_terms" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
        <div class="vm-layout">
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="modal-content style-black no-border-radius no-shadow no-border no-padding-top ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                            <img src="{{asset('images/white_close.png')}}" alt="close">
                        </button>
                        <div class="modal-body ">
                            <div class="body-with-scroll">
                                <div class="col-lg-10 col-lg-offset-1 clear-before-after text-white">
                                   <h2 class="text-white"><?php echo cmskey('newsletter_title');?></h2>
                                    <?php echo cmskey('newsletter_details');?>
                                </div>                          
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('scripts')
	<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/popper.min.js?v=1')}}"></script> 
    <script type="text/javascript">
    	function changeStatus(){
            if($('#checkbox-1').is(':checked')){
                $('#submit_button').removeAttr('disabled');
                $("#fbook").attr('onclick',"facebookLogin()").removeAttr('disabled');            
            }else{
                $('#submit_button').attr('disabled','disabled');
                $("#fbook").removeAttr('onclick').attr('disabled','disabled');
            }
        }

        function facebookLogin(){
            trackNavigate('ProfileCreationFacebook','{{url('social/auth/redirect/facebook')}}');

        }
    	function submitUserForm(){
    		if($('#add_user').valid()){
    			if($('#checkbox-1').is(':checked')){
    				var email = $( "#email" ).val();
    				$.ajax({
			            url: "{{url('uniqeEmail')}}",
			            type: "get",
			            data: {email:email},
			            success: function(res){
			                
                            if(res.trim() == 'true'){
			                	$('#add_user').submit();
			                }else{
			                	alert('<?php echo cmskey("email_already_in_use",true); ?>');
			                }
			            }
			        });
    			}else{
    				//alert('<?php cmskey("agree_term_and_condition_error",true); ?>');
    			}
    		}
    		return false;
    	}

        function avoidSpace(event) {
            var k = event ? event.which : window.event.keyCode;
            if (k == 32) return false;
        }

	    $(document).ready(function(){
            $('body').addClass('bg-white');
            $('[data-toggle="tooltip"]').tooltip();
	    	options = {
	                rules: {
	                    "first_name": {"required":true,'minlength':2,'maxlength':18},
                        "last_name": {"required":true,'minlength':2,'maxlength':18},
	                    "email"		:{
	                    	required:true,
	                    	email:true
						},
	                    "password": {
                            "required":true,
                            'minlength':8
                        },
					    "confirm_password": {
					      "equalTo": "#password",
					      'minlength':8
					    }
					    
	                },
	                messages: {
                        "first_name": {"required":"Indtast venligst fornavn",'minlength':'Indtast minimum 2 bogstaver','maxlength':'Indtast mellem to og 18 bogstaver'},
                        "last_name": {"required":"Indtast venligst efternavn",'minlength':'Indtast minimum 2 bogstaver','maxlength':'Indtast mellem to og 18 bogstaver'},
                        "email"     :{ 
                            required : "Indtast venligst E-mail" , 
                            email : 'Indtast venligst en gyldig E-mail'
                        },
                        "password": {
                            "required":"Indtast password",
                            'minlength':"Minum længde er syv tegn"
                        },
                        "confirmed": {
                          "equalTo": "Password er ikke identiske",
                          'minlength':"Minum længde er syv tegn"
                        }
                    }
	            };
	            $('#add_user').validate( options );
		    });
	</script>
@endsection