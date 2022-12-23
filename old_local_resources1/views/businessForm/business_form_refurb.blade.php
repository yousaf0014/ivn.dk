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
div.product-content img.img-responsive{
	margin: auto;
}
</style>
<div id="main-body">
	<section id="slider" style="background-image:url('{{asset('user_images/'.$contentData->image_path)}}')">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!--<img class="img-responsive" src="{{ asset('uploads/user/'.$business->profile_image) }}"> -->
				</div>
			</div>
		</div>
	</section>
	<section id="introtext">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center"><?php echo $contentData->title; ?></h2>
					<p class="text-center pt-3"><?php echo html_entity_decode($contentData->content); ?></p>
				</div>
			</div>
		</div>
	</section>
	<section id="product-categories">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 text-center">
					<!-- 1st Box -->
					<div class="product-box">
						<div class="product-content">
							<img class="img-responsive" src="{{asset('images/business-units/Bærbare_v2.png')}}">
							<h3><?php echo cmskey('refurb_product1_heading'); ?></h3>
							<p class="pt-5 text-light"><?php echo cmskey('refurb_product1_text'); ?></p>
						</div>
					</div>
					<!-- 2nd Box -->
					<div class="product-box">
						<div class="product-content">
							<img class="img-responsive" src="{{asset('images/business-units/stationære_v2.png')}}">
							<h3><?php echo cmskey('refurb_product2_heading'); ?></h3>
							<p class="pt-5 text-light"><?php echo cmskey('refurb_product2_text'); ?></p>
						</div>
					</div>
					<!-- 3rd Box -->
					<div class="product-box">
						<div class="product-content">
							<img class="img-responsive" src="{{asset('images/business-units/tablets_v2.png')}}">
							<h3><?php echo cmskey('refurb_product3_heading'); ?></h3>
							<p class="pt-5 text-light"><?php echo cmskey('refurb_product3_text'); ?></p>
						</div>
					</div>
					<!-- 3rd Box -->
					<div class="product-box">
						<div class="product-content">
							<img class="img-responsive" src="{{asset('images/business-units/Mobiltelefoner_v2.png')}}">
							<h3><?php echo cmskey('refurb_product4_heading'); ?></h3>
							<p class="pt-5 text-light"><?php echo cmskey('refurb_product4_text'); ?></p>
						</div>
					</div>
					<!-- 3rd Box -->
					<div class="product-box">
						<div class="product-content">
							<img class="img-responsive" src="{{asset('images/business-units/Tilbehør_v2.png')}}">
							<h3><?php echo cmskey('refurb_product5_heading'); ?></h3>
							<p class="pt-5 text-light"><?php echo cmskey('refurb_product5_text'); ?></p>
						</div>
					</div>
					<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
						<div class="text-center product-btn">
							<a class="btn" href="javascript:;" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','Refurb');openwindow()">
							<img src="{{asset('images/business-units/basket.png')}}">
							Køb IT hos Refurb med rabat</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>


	<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
		echo 'CMS key name for refurb email code is:refurb_email_code_premium / refurb_email_code_pro.<br/><b>this code will be sent in email.</b>';

	}?>
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
<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
<div style="display:none;">
	<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm">
		<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
		{{ csrf_field() }}	
	</form>
</div>
<?php } ?>
@endsection
@section('scripts')
<link href="{{asset('css/refurb_style.css?v=1')}}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
	function openwindow(){
		window.open('https://www.refurb.dk','_blank');
		$('#businessForm').submit();
	}
	
	$(document).ready(function(){
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