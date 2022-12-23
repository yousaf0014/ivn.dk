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
	      		<img src="{{asset('user_images/'.$contentData->image_path)}}" alt="slider image" class="img-responsive img-bu-slider">
	      		<div class="carousel-caption">
	        		<div class="container heightFull">
	        			<div class="row heightFull">
	        				<div class="col-md-12 heightFull pos-relative">
	        					<div class="bu-logo top-left">
	        						<a href="#">
	        							<img src="{{ asset('uploads/user/' . $business->profile_image) }}" class="img-bofinans logo" alt="bofinans logo">
	        						</a>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	      		</div>
	    	</div>
	  	</div>	  
	</div>
</div>

<div class="clearing"></div>
<div class="bu-welcome-msg">
	<div class="container">
		<div class="row">
			<dic class="col-sm-8 col-sm-offset-2">
				<h1><?php echo $contentData->title; ?></h1>
				<p>
					<?php echo html_entity_decode($contentData->content); ?>
				</p>
			</dic>
		</div>
	</div>
</div>
<div class="clearing"></div>
<div class="highlighted-descriptions-area bg-dk-blue">
	<div class="engl-tp sec-angl"><span class="fa fa-caret-down txt-white"></span></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2><?php echo cmskey('bofinans_blue_area_heading'); ?></h2>
				<hr class="style-orange" />

			</div>
			<div class="clearing"></div>
			<div class="col-sm-10 col-sm-offset-1">
				<?php echo cmskey('bofinans_blue_area_text'); ?>
			</div>
		</div>
	</div>
	<div class="height-50 dummy-div"></div>
	<div class="engl-dw sec-angl"><span class="fa fa-caret-down txt-dk-blue"></span></div>
</div>
<div class="clearing"></div>
<div class="bu-feautes-listing bg-white">
	<div class="engl-tp sec-angl"><span class="fa fa-caret-down txt-white"></span></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2><?php echo cmskey('bofinans_white_area_text_heading'); ?></h2>
				<hr class="style-orange" />
			</div>
			<div class="clearing"></div>
			<div class="col-sm-6 col-sm-offset-3">
				<p><?php echo cmskey('bofinans_white_area_text_text'); ?></p>
			</div>
			<div class="clearing"></div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="col-xs-4 text-center feature-grid-txt">
						<h4><?php echo cmskey('bofinans_white_area_point1_heading'); ?></h4>
						<img src="{{asset('images/business-units/img-angle-down-orange.png')}}" alt="ic">
						<p><?php echo cmskey('bofinans_white_area_point1_text'); ?></p>
					</div>
					<div class="col-xs-4 text-center feature-grid-txt">
						<h4><?php echo cmskey('bofinans_white_area_point2_heading'); ?></h4>
						<img src="{{asset('images/business-units/img-angle-down-orange.png')}}" alt="ic">
						<p><?php echo cmskey('bofinans_white_area_point2_text'); ?></p>
					</div>
					<div class="col-xs-4 text-center feature-grid-txt">
						<h4><?php echo cmskey('bofinans_white_area_point3_heading'); ?></h4>
						<img src="{{asset('images/business-units/img-angle-down-orange.png')}}" alt="ic">
						<p><?php echo cmskey('bofinans_white_area_point3_text'); ?></p>
					</div>
				</div>
			</div>
			<div class="clearing"></div>
			<div class="col-md-12">
				<h3><?php // echo cmskey('bofinans_white_area_text_message'); ?></h3>
			</div>
		</div>
	</div>
</div>
<div class="clearing"></div>

<div class="bu-footer-style-1 bg-dk-blue">
	<div class="engl-tp sec-angl"><span class="fa fa-caret-down txt-white"></span></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h2><?php echo cmskey('bofinans_form_area_heading'); ?></h2>
				<p><?php echo cmskey('bofinans_form_area_text'); ?></p>
				<?php $user = AUth::user(); ?>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="bu-ftr-contact-frm">
					<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>							
					<form action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm"enctype="multipart/form-data">
						{{ csrf_field() }}
					<?php } ?>
						<div class="frm-head">
							<div class="title-frm"><?php echo cmskey('bofinans_form_heading'); ?></div>
							<p><?php echo cmskey('bofinans_form_message'); ?></p>
						</div>
						<dv class="frm-ctnt">
							<div class="frm-grp">
								<input type="text" name="name" placeholder="Navn:" class="frm-f" required="true" value="{{$user->last_name}}">
							</div>
							<div class="frm-grp">
								<input type="text" name="first_name" placeholder="Firmanavn:" class="frm-f" required="true" value="{{$user->first_name}}">
							</div>
							<div class="frm-grp">
								<input type="email" name="email" placeholder="E-mail:" class="frm-f" required="true" email="true" readonly="readonly"  value="{{$user->email}}">
							</div>
							<div class="frm-grp">
								<input type="text" name="telephone" placeholder="Telefonnr.:" class="frm-f" required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}">
							</div>
							<div class="frm-grp">
								<input type="text" name="post_code" placeholder="Postnr.:" class="frm-f" required="true" number="true" value="{{$user->zipcode}}">
							</div>
							<div class="frm-grp">
								<input type="text" name="address" placeholder="Evt. Adresse:" class="frm-f" required="true" value="{{$user->address}}">
							</div>
							<div class="frm-grp">
								<textarea name="details" rows="3" placeholder="Kommentarer:" class="frm-f"></textarea>
							</div>
						<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>							
					
							<div class="frm-grp-btn">
								<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
								<input type="submit"  onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','Bofinans')" name="" value="Kontakt mig" class="btnSubmt">
							</div>
						</dv>
					</form>
						<?php }else{?>
							<div class="frm-grp-btn">
								<input type="submit"  onclick="showpopup()" name="" value="Kontakt mig" class="btnSubmt">
							</div>
						<?php } ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<hr class="style-orange" />
						<h3 class="btm-text"><?php echo cmskey('bofinans_bottom_text'); ?></h3>
					</div>
				</div>
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