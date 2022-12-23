@extends('layouts.default.app')
@section('content')
<style type="text/css">
	div.validation_error {
    color: #790000;
    font-size: 1em;
    font-weight: 700;
    margin-bottom: 25px;
    border-top: 2px solid #790000;
    border-bottom: 2px solid #790000;
    padding: 16px 0;
    clear: both;
    width: 100%;
    text-align: center;
}
div.frm-bu-style-11 div.frm-fld input[type="text"], div.frm-bu-style-11 div.frm-fld label{ 
	font-family: Lato,sans-serif !important; 
}
</style>
<div class="business-unit-slider">
	<div id="slider-BU" class="carousel slide" data-ride="carousel">
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	    <div class="item active">
	      <img src="{{asset('user_images/'.$contentData->image_path)}}" alt="BDU slider image" class="img-responsive img-bu-slider">
	      <div class="carousel-caption">
	        <div class="container heightFull">
	        	<div class="row heightFull">
	        		<div class="col-md-12 heightFull pos-relative">
	        			<div class="bu-logo">
	        				<a href="#">
	        				<!--	<img src="{{ asset('uploads/user/' . $business->profile_image) }}" class="img-bdo-logo" alt="bdo logo"> -->
	        				</a>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </div>
	    </div>
	  </div>
	  <!-- Controls -->
	  <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a> -->
	</div>
</div>
<div class="clearing"></div>
<div class="bu-welcome-msg">
	<div class="container">
		<div class="row">
			<dic class="col-md-12">
				<h1><?php echo $contentData->title; ?></h1>
				<p>
					<?php echo html_entity_decode($contentData->content); ?>
				</p>
				<hr class="style-black">
			</dic>
		</div>
	</div>
</div>
<div class="clearing"></div>

<div class="bu-features">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="heading-w-sub-heading text-center">
					<!-- <h3 class="style-light"></h3> -->
					<h2 class="style-bold playregular"><?php echo cmskey('lendino_center_area_heading');?></h2>
					<p class="desc playregular"><?php echo cmskey('lendino_center_text');?>:</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="bu-benifits">

						<div class="bu-benifits-box">
							<div class="ic">
								<img src="{{asset('images/business-units/img-lendino-icon.png')}}" height="60">
							</div>
							<div class="txt"><?php echo cmskey('lendino_center_col1_text');?></div>
						</div>

						<div class="bu-benifits-box">
							<div class="ic">
								<img src="{{asset('images/business-units/img-lendino-icon.png')}}" height="60">
							</div>
							<div class="txt"><?php echo cmskey('lendino_center_col2_text');?></div>
						</div>

						<div class="bu-benifits-box">
							<div class="ic">
								<img src="{{asset('images/business-units/img-lendino-icon.png')}}" height="60">
							</div>
							<div class="txt"><?php echo cmskey('lendino_center_col3_text');?></div>
						</div>

						<div class="bu-benifits-box">
							<div class="ic">
								<img src="{{asset('images/business-units/img-lendino-icon.png')}}" height="60">
							</div>
							<div class="txt"><?php echo cmskey('lendino_center_col4_text');?></div>
						</div>

					</div>
					<div class="clearing"></div>
					<p class="sm-txt text-center bu-benitifts-info"><?php echo cmskey('lendino_center_details');?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearing"></div>
<div class="bg-line-full green h-35"></div>
<div class="frm-bu-style-11">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2><?php echo cmskey('lendino_form_heading');?></h2>
				<p><?php echo cmskey('lendino_form_details');?></p>
				<?php $user = AUth::user(); ?>
				
				<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
				<form action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm"enctype="multipart/form-data">
					{{ csrf_field() }}
				<?php } ?>
					<div class="frm-fld">
						<label class="col-xs-12 col-sm-3 col-md-3">Virksomhed:*</label>
						<div class="col-xs-12 col-sm-9 col-md-9">
							<input type="text" name="name" class="frmfldbox" required="true" value="{{$userCompany->name}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-3 col-md-3">Ejer:*</label>
						<div class="col-xs-12 col-sm-9 col-md-9">
							<input type="text" name="user_name" class="frmfldbox" required="true" value="{{$user->first_name.' '.$user->last_name}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-3 col-md-3">Mobiltelefon:*</label>
						<div class="col-xs-12 col-sm-9 col-md-9">
							<input type="text" name="telephone" class="frmfldbox"  required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-3 col-md-3">E-mail:*</label>
						<div class="col-xs-12 col-sm-9 col-md-9">
							<input type="email" name="email" class="frmfldbox" required="true" email="true" readonly="readonly" value="{{$user->email}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-3 col-md-3">Formål:*</label>
						<div class="col-xs-12 col-sm-9 col-md-9">
							<select name="others" class="frmfldbox" reqired="true">
								<option value="Driftskapital">Driftskapital</option>
								<option value="Mellemfinansiering">Mellemfinansiering</option>								
								<option value="Investering">Investering</option>								
								<option value="Køb af virksomhed">Køb af virksomhed</option>								
								<option value="Ordrefinansiering">Ordrefinansiering</option>
								<option value="Omlægning af gæld">Omlægning af gæld</option>
								<option value="Generationsskifte">Generationsskifte</option>
								<option value="Ejendomsfinansiering">Ejendomsfinansiering</option>
								<option value="Andet">Andet</option>
							</select>
						</div>
					</div>
					<div class="frm-fld">
						<p>Felter markeret med * skal udfyldes</p>
					</div>
					<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>							
					<div class="frm-fld text-center">
						<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
						<input type="button" onclick="submitForm()"  value="Send" class="btn btnSubmt">
					</div>
				</form>
					<?php }else{ ?>
						<div class="frm-fld text-center">
							<input type="button" onclick="showpopup()"  value="Send" class="btn btnSubmt">
						</div>
					<?php } ?>
			</div>
		</div>
	</div>
</div>

<!-- popups -->
<div class="modal fade" id="msg-stopper-for-lower-users" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="vm-layout">
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="modal-content no-border-radius no-shadow no-border  padding-left-25 padding-right-25">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('images/icons/img-modal-close.png')}}" alt="close">
                        </button>
                        <div class="modal-header margin-bottom-30">
                            <h4 class="modal-title">
                                <?php echo  cmskey('welcome_message_header');?>
                            </h4>
                        </div>
                        <div class="modal-body padding-bottom-70">
                            <div class="desc margin-bottom-20">
                                <p class="text-center f-s-18 line-height-30">
                                    <?php echo  cmskey('welcome_message_details');?>
                                </p>
                            </div>
                            <div class="popup-buttons text-center margin-top-70">
                                <a href="{{url('subscription')}}" style="margin-right:10px;" class="btn btn-primary btn-popup min-width-300">Opgrader nu</a>
                                <a href="javascript:;" onclick="$('#msg-stopper-for-lower-users').modal('hide');" class="btn btn-primary btn-popup min-width-300">Ikke nu</a>
                            </div>
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
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
	function submitForm(){
		sendbuttonTrack1('Tilmeldinger','tilmelding','Lendino');
		setTimeout('sendForm()',2000);
	}

	function sendForm(){
		$("#businessForm").submit();
	}
	function changeRadio(fieldName){
		if(!$('#r_'+fieldName).is(':checked')){
			$('#r_'+fieldName).attr('checked','checked');
			$('#'+fieldName).css("background", "green");
		}else{
			$('#r_'+fieldName).removeAttr('checked');
			$('#'+fieldName).css("background", "white");
		}
	}
	$(document).ready(function(){
		$("#businessForm").validate();
		<?php if(!$canUserSubscribe){ ?>
			/*$("#msg-stopper-for-lower-users").modal({
			  backdrop:"static",
			  keyboard: false
			}); */

		<?php } ?>
	});

	function showpopup(){
		$('#msg-stopper-for-lower-users').modal('show');
	}
</script>
@endsection