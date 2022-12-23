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
	        					<!-- <img src="{{ asset('uploads/user/' . $business->profile_image) }}" class="img-bdo-logo" alt="bdo logo"> -->
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
				<!-- <hr class="style-black"> -->
			</dic>
		</div>
	</div>
</div>
<div class="clearing"></div>

<?php /*

<div class="bu-features">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="heading-w-sub-heading text-center">
					<h3 class="style-light"><?php echo cmskey('glitnr_center_area_small_heading');?></h3>
					<h2 class="style-bold"><?php echo cmskey('glitnr_center_area_main_heading');?></h2>
				</div>
			</div>
			<div class="col-sm-3 col-xs-12 text-center bu-single-feature">
				<div class="img"><img src="{{asset('images/business-units/INDHENT-TILBUD.jpg')}}" alt="INDHENT-TILBUD.jpg"></div>
				<div class="link"><a href="#"><?php echo cmskey('glitnr_center_area_col1_heading');?></a></div>
				<p><?php echo cmskey('glitnr_center_area_col1_text');?></p>
			</div>
			<div class="col-sm-3 col-xs-12 text-center bu-single-feature">
				<div class="img"><img src="{{asset('images/business-units/MODTAG-TILBUD.jpg')}}" alt="MODTAG-TILBUD.jpg"></div>
				<div class="link"><a href="#"><?php echo cmskey('glitnr_center_area_col2_heading');?></a></div>
				<p><?php echo cmskey('glitnr_center_area_col2_text');?></p>
			</div>
			<div class="col-sm-3 col-xs-12 text-center bu-single-feature">
				<div class="img"><img src="{{asset('images/business-units/MODTAG-RÅDGIVNING.jpg')}}" alt="MODTAG-RÅDGIVNING.jpg"></div>
				<div class="link"><a href="#"><?php echo cmskey('glitnr_center_area_col3_heading'); ?></a></div>
				<p><?php echo cmskey('glitnr_center_area_col3_text');?></p>
			</div>
			<div class="col-sm-3 col-xs-12 text-center bu-single-feature">
				<div class="img"><img src="{{asset('images/business-units/BETAL-ONLINE.jpg')}}" alt="BETAL-ONLINE.jpg"></div>
				<div class="link"><a href="#"><?php echo cmskey('glitnr_center_area_col4_heading');?></a></div>
				<p><?php echo cmskey('glitnr_center_area_col4_text');?></p>
			</div>
		</div>
	</div>
</div>
<div class="clearing"></div>
*/ ?>

<div class="frm-bu-style-10">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="frm-heading"><?php echo cmskey('glitnr_form_heading');?></h2>
			</div>
			<div class="clearing"></div>
			<?php $user = Auth::user(); ?>
		<form action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm"enctype="multipart/form-data">
			{{ csrf_field() }}
			<?php /*
					
			<div class="row">
				<div class="col-xs-12 col-sm-5">
					<p class="mob-padd"><?php echo cmskey('glitnr_form_text');?></p>
				</div>
				<div class="col-xs-12 col-sm-7">
					<div class="clearing"></div>
					<div class="frm-fld">
						<label class="col-xs-12 col-sm-4">CVR:*</label>
						<div class="fldbox col-xs-12 col-sm-8">
							<input type="text" name="cvr" class="frmfldbox" required="true" value="{{$userCompany->cvr}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-4">Dit navn:*</label>
						<div class="fldbox col-xs-12 col-sm-8">
							<input type="text" name="first_name" class="frmfldbox" required="true" value="{{$user->first_name.' '.$user->last_name}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-4">Mobiltelefon:*</label>
						<div class="fldbox col-xs-12 col-sm-8">
							<input type="text" name="telephone" class="frmfldbox" required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}">
						</div>
					</div>

					<div class="frm-fld">
						<label class="col-xs-12 col-sm-4">E-mail:*</label>
						<div class="fldbox col-xs-12 col-sm-8">
							<input type="email" name="email" class="frmfldbox"  required="true" email="true" value="{{$user->email}}" readonly="readonly">
						</div>
					</div>
					
				</div>
			</div>
			*/?>
			<div class="row">
				<?php /*
				<div class="col-xs-12">
					<div class="frm-fld">
						<label class="col-xs-12 col-md-2 col-sm-4">Om sagen:*</label>
						<div class="fldbox col-xs-12 col-md-10 col-sm-8">
							<input type="text" name="fax" class="frmfldbox" required="true" placeholder="Fx: Jeg skal bruge en ansættelseskontrakt">
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="frm-fld">
						<label class="col-xs-12 mr-10">Beskriv sagen så detaljeret som muligt:*</label>
						<div class="fldbox col-xs-12">
							<textarea name="details" class="frmfldbox" required="true" rows="5" placeholder="Fx: Jeg er klar til at ansætte min første medarbejder, og jeg skal bruge en ansættelses-
kontrakt, der tager højde for...."></textarea>
						</div>
					</div>
				</div> */ ?>
				<div class="col-xs-12 text-center">
					<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
					<input type="button" onclick="opentab();"  value="Send" class="btn btnSubmt">
				</div>
			</div>
		</form>
		</div>
	</div>
	<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
		echo 'CMS key name for glitnr email code is:glitnr_email_code.<br/><b>this code will be sent in email.</b>';

	} ?>
</div>

<div class="clearing"></div>
<div class="modal fade" id="msg-stopper-for-lower-users" tabindex="-1" role="dialog">
	<div class="modal-dialog w1060 " role="document">
		<div class="vm-layout">
			<div class="vm-layout-content">
				<div class="vm-padding">
					<div class="modal-content no-border-radius no-shadow no-border  padding-left-85 padding-right-85">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.href='{{url('home')}}'">
							<img src="{{url('images/icons/img-modal-close.png')}}" alt="close">
						</button>
						<div class="modal-header margin-bottom-55">
							<h4 class="modal-title">
								<?php echo  cmskey('my_subscription_page_popup_title');?>
							</h4>
						</div>
						<div class="modal-body padding-bottom-100">
							<div class="desc margin-bottom-20">
								<p class="text-center">
									<?php echo  cmskey('my_subscription_page_popup_details');?>
								</p>
							</div>

							<div class="popup-buttons text-center margin-top-70">
								<a href="{{url('subscription')}}" class="btn btn-primary btn-popup min-width-500">Opgrader nu</a>
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
function opentab(){
		sendbuttonTrack1('Tilmeldinger','tilmelding','Glitnr')
		window.open('http://glitnr.dk/', '_blank');
		setTimeout('submitForm()',2000);
		
	}
	function submitForm(){
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
		/* $('#msg-stopper-for-lower-users').modal('show'); */
	}
</script>
@endsection