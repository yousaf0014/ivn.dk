@extends('layouts.default.app')
@section('content')

<div id="cover">
	<div class="business-unit-slider">
		<div id="slider-Billy" class="carousel slide" data-ride="carousel">
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="{{asset('user_images/'.$contentData->image_path)}}" alt="Billy slider image" class="img-responsive img-bu-slider">
				</div>
			</div>		  
		</div>
	</div>
	<div id="maintext">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center"><?php echo $contentData->title; ?></h2>
					<p class="text-center"><?php echo html_entity_decode($contentData->content); ?></p>
					<div class="main-button">
						<button type="button" onclick="window.open('https://www.randstad.dk/virksomhed/send-foresporgsel/')" class="btn">Kontakt os</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div id="randstad">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><?php echo cmskey('randstad_cener_bule_header'); ?></h2>
					<ul class="randstad-list">
						<li class="items">
							<img src="{{asset('images/business-units/icon-1.png')}}" class="img-fluid">
							<p><?php echo cmskey('randstad_col1_text'); ?></p>
						</li>
						<li class="items">
							<img src="{{asset('images/business-units/icon-2.png')}}" class="img-fluid">
							<p><?php echo cmskey('randstad_col2_text'); ?></p>
						</li>
						<li class="items">
							<img src="{{asset('images/business-units/icon-3.png')}}" class="img-fluid">
							<p><?php echo cmskey('randstad_col3_text'); ?></p>
						</li>
						<li class="items">
							<img src="{{asset('images/business-units/icon-4.png')}}" class="img-fluid">
							<p><?php echo cmskey('randstad_col4_text'); ?></p>
						</li>
						<li class="items">
							<img src="{{asset('images/business-units/icon-5.png')}}" class="img-fluid">
							<p><?php echo cmskey('randstad_col5_text'); ?></p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<div id="artikier">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><?php echo cmskey('randstad_cener_light_bule_header'); ?></h2>
					<div class="col-sm-6">
						<div class="content">
							<div class="d-inline artikier-sm artikier-lg"><img src="{{asset('images/business-units/ivn-randstad-artikel1.jpg')}}"></div>
							<div class="d-inline artikier-text">
								<p><?php echo cmskey('randstad_cener_light_bule_text1'); ?></p>
								<span class="pull-right text-underline">
									<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
									 	echo 'key for target page url "randstad_cener_light_bule_readmore1"';
									 } ?>
									<span class="pull-right text-underline"><a href="{{cmskey('randstad_cener_light_bule_readmore1',true)}}" target="_blank">Læs mere</a></span>

								</span>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="content">
							<div class="d-inline artikier-sm artikier-lg"><img src="{{asset('images/business-units/ivn-randstad-artikel2.jpg')}}"></div>
							<div class="d-inline artikier-text">
								<p><?php echo cmskey('randstad_cener_light_bule_text2'); ?></p>
								<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
								 	echo 'key for target page url "randstad_cener_light_bule_readmore2"';
								 } ?>
								<span class="pull-right text-underline"><a href="{{cmskey('randstad_cener_light_bule_readmore2',true)}}" target="_blank">Læs mere</a></span>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="content">
							<div class="d-inline artikier-sm artikier-lg"><img src="{{asset('images/business-units/ivn-randstad-artikel3.jpg')}}"></div>
							<div class="d-inline artikier-text">
								<p><?php echo cmskey('randstad_cener_light_bule_text3'); ?></p>
								<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
								 	echo 'key for target page url "randstad_cener_light_bule_readmore3"';
								 } ?>
								<span class="pull-right text-underline"><a href="{{cmskey('randstad_cener_light_bule_readmore3',true)}}" target="_blank">Læs mere</a></span>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6"> <!-- col-md-6 -->
						<div class="content">
							<div class="d-inline artikier-sm artikier-lg"><img src="{{asset('images/business-units/ivn-randstad-artikel-4.jpg')}}"></div>
							<div class="d-inline artikier-text">
								<p><?php echo cmskey('randstad_cener_light_bule_text4'); ?></p>
								<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
								 	echo 'key for target page url "randstad_cener_light_bule_readmore4"';
								 } ?>
								<span class="pull-right text-underline"><a href="{{cmskey('randstad_cener_light_bule_readmore4',true)}}" target="_blank">Læs mere</a></span>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="content">
							<div class="d-inline artikier-sm artikier-lg"><img src="{{asset('images/business-units/ivn-randstad-artikel5.jpg')}}"></div>
							<div class="d-inline artikier-text">
								<p><?php echo cmskey('randstad_cener_light_bule_text5'); ?></p>
								<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
								 	echo 'key for target page url "randstad_cener_light_bule_readmore5"';
								 } ?>
								<span class="pull-right text-underline"><a href="{{cmskey('randstad_cener_light_bule_readmore5',true)}}" target="_blank">Læs mere</a></span>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="content">
							<div class="d-inline artikier-sm artikier-lg"><img src="{{asset('images/business-units/ivn-randstad-artikel6.jpg')}}"></div>
							<div class="d-inline artikier-text">
								<p><?php echo cmskey('randstad_cener_light_bule_text6'); ?></p>
								<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
								 	echo 'key for target page url "randstad_cener_light_bule_readmore6"';
								 } ?>
								<span class="pull-right text-underline"><a href="{{cmskey('randstad_cener_light_bule_readmore6',true)}}" target="_blank">Læs mere</a></span>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				<!--	<p class="text-underline">Follow the link to view more</p> -->
				</div>
			</div>
		</div>
	</div>

	<!-- Footer Area -->
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><?php echo cmskey('randstad_bottom_text_header'); ?></h2>
					<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
					<div class="main-button">
						<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
						 	echo 'key for target page url "randstad_cener_light_bule_readmore1"';
						 } ?>
						<button style="color:white !important;background-color:#03104a !important;" type="button" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','randstad');openWin()" class="button"><?php echo cmskey('randstad_bottom_button_text'); ?></button>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

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
<link href="{{asset('css/ranstand_fonts.css?v=1')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/ranstand_styles.css?v=1')}}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
	function openWin(){
		window.open("{{cmskey('randstad_last_button_url',true)}}");
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