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
	        					<!-- <img src="{{asset('uploads/user/'. $business->profile_image) }}" class="img-bdo-logo" alt="bdo logo"> -->
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
<?php /*
<div class="bu-features">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="heading-w-sub-heading text-center">
					<!-- <h3 class="style-light"></h3> -->
					<h2 class="style-bold"><?php echo cmskey('innovation_lab_center_area_heading');?></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="col-sm-4 col-xs-12 text-center bu-single-feature">
						<div class="img"><img src="{{asset('images/business-units/img-workshop-balck.png')}}" alt="img-workshop-balck"></div>
						<div class="link"><a href="#"><?php echo cmskey('innovation_lab_center_area_col1_heading');?></a></div>
						<p class="text-center"><?php echo cmskey('innovation_lab_center_area_col1_text');?></p>
					</div>
					<div class="col-sm-4 col-xs-12 text-center bu-single-feature">
						<div class="img"><img src="{{asset('images/business-units/img-projects-black.png')}}" alt="img-projects-black"></div>
						<div class="link"><a href="#"><?php echo cmskey('innovation_lab_center_area_col2_heading');?></a></div>
						<p class="text-center"><?php echo cmskey('innovation_lab_center_area_col2_text');?></p>
					</div>
					<div class="col-sm-4 col-xs-12 text-center bu-single-feature">
						<div class="img"><img src="{{asset('images/business-units/img-digital-black.png')}}" alt="img-digital-black"></div>
						<div class="link"><a href="#"><?php echo cmskey('innovation_lab_center_area_col3_heading');?></a></div>
						<p class="text-center"><?php echo cmskey('innovation_lab_center_area_col3_text');?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearing"></div>

<div class="bu-video-box-fixed-width">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2 class="v-heading"><?php echo cmskey('innovation_lab_bottom_heading');?>:</h2>
				<div class="videobox">
					<?php $url = cmskey('innovation_lab_video_link',true); 
						if($url != 'innovation_lab_video_link'){
					?>
						<iframe width="100%" height="315" src="{{$url}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					<?php }else{ ?>
						<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){ ?>
							To show or change video please provide value for key:<?php echo cmskey('innovation_lab_video_link',true);
						}?>
						<img src="{{asset('images/business-units/innovation-lab-video-thumb.jpg')}}" class="img-responsive">
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
*/ ?>
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
		//$("#businessForm").validate();
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