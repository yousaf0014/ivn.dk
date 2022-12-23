@extends('layouts.default.app')
@section('content')
<div id="main-body">
	<section id="slider" style="background-image:url('{{asset('user_images/'.$contentData->image_path)}}')">
	</section>
	<section id="introtext" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-xs-8 clearfix mx-auto">
						<h2 class="text-center pb-5"><?php echo $contentData->title; ?></h2>
						<p class="text-center"><?php echo html_entity_decode($contentData->content); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Border Bottom -->

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="border-bottom"></div>
			</div>
		</div>
	</div>

	<!-- Start Img text Section -->

	<section id="img-text" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="w-80 mx-auto">
						<h2 class="text-center pb-5"><?php echo cmskey('business_if_main_area_heading'); ?></h2>
						<img class="img-responsive" src="{{asset('images/business-units/img-text.jpg')}}">
						<div class="col-md-6 mx-auto col-xs-10 md-f-none">
							<div class="content">
								<h3><?php echo cmskey('business_if_text_cms1_heading'); ?></h3>
								<p><?php echo cmskey('business_if_text_cms1_text'); ?></p>
							</div>
							<div class="content">
								<h3><?php echo cmskey('business_if_text_cms2_heading'); ?></h3>
								<p><?php echo cmskey('business_if_text_cms2_text'); ?></p>
								<div class="text-right">
									<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
											echo 'CMS key name for Business IF readmore link more 1 :business_if_readmore1_link.<br/>';
									}?>
									<a class="btn btn-lg" href="{{cmskey('business_if_readmore1_link',true)}}" target="_blank">Læs mere</a>
								</div>
							</div>
						</div>
						<div class="col-md-6 mx-auto col-xs-10 md-f-none">
							<div class="content">
								<h3><?php echo cmskey('business_if_text_cms3_heading'); ?></h3>
								<p><?php echo cmskey('business_if_text_cms3_text'); ?></p>
								<div class="text-right">
									<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
											echo 'CMS key name for Business IF readmore link more 2 :business_if_readmore2_link.<br/>';
									}?>
									<a class="btn btn-lg" href="{{cmskey('business_if_readmore2_link',true)}}" target="_blank">Læs mere</a>
								</div>
							</div>
							<div class="content">
								<h3><?php echo cmskey('business_if_text_cms4_heading'); ?></h3>
								<p><?php echo cmskey('business_if_text_cms4_text'); ?></p>
								
							</div>
							<div class="content">
								<h3><?php echo cmskey('business_if_text_cms5_heading'); ?></h3>
								<p><?php echo cmskey('business_if_text_cms5_text'); ?></p>
								
							</div>
							<div class="content">
								<h3><?php echo cmskey('business_if_text_cms6_heading'); ?></h3>
								<p><?php echo cmskey('business_if_text_cms6_text'); ?></p>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<section id="signup" class="bg-success py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="w-60 mx-auto">
						<h2 class="text-center pb-3 text-uppercase"><?php echo cmskey('business_if_form_heading'); ?></h2>
						<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm" enctype="multipart/form-data">
							<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
							{{ csrf_field() }}	
							<?php $user = Auth::user(); ?>									
							<div class="form-group">
								<label>Virksomhedsnavn:</label>
								<input type="text" class="form-control" placeholder="Virksomhedsnavn" name="Virksomhedsnavn" required="true">
							</div>
							<div class="form-group">
								<label >CVR Nr:</label>
								<input type="text" class="form-control" placeholder="CVR" name="cvr"  value="{{$user->cpr}}"  required="true">
							</div>
							<div class="form-group">
								<label >Email:</label>
								<input type="email" class="form-control" placeholder="Email" name="email" readonly="readonly" value="{{$user->email}}"  required="true">
							</div>
							<div class="form-group">
								<label >Navn:</label>
								<input type="text" class="form-control" placeholder="Navn" name="name" value="{{$user->first_name.' '.$user->last_name}}"  required="true">
							</div>
							<div class="form-group">
								<label for="tel">Telefonnr:</label>
								<input type="text" class="form-control" placeholder="Telefonnr" name="telephone" required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}">
							</div>
							<div class="form-group">
								<label for="about">Information om dit forsikringsbehov:</label>
								<textarea class="form-control" name="details" rows="7"></textarea>
							</div>
							<div class="text-center">
								<button type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','IF')" class="btn btn-default">Kontakt mig</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
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
<div style="display:none;">
	<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm">
		<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
		{{ csrf_field() }}	
	</form>
</div>
@endsection
@section('scripts')
<link href="{{asset('css/if_style.css?v=1')}}" rel="stylesheet" type="text/css">
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
		/* $('#msg-stopper-for-lower-users').modal('show'); */
	}
</script>
@endsection