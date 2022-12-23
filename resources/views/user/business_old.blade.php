@extends('layouts.default.app')
@section('content')
<link rel="stylesheet" href="{!! asset('css/form.css')!!}">
<div class="block-rdm-gtwy-colltn">
	<div class="rdm-gtwy-top-area" style="background-image:url('{{asset('user_images/'.$contentData->image_path)}}');">
		<div class="vm-layout">
			<div class="vm-layout-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1><?php echo $contentData->image_title; ?></h1>
							<p><?php echo $contentData->image_details; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="rdm-gtwy-frm-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
							<h2 class="pHeading"><?php echo  $contentData->title; ?></h2>
							<div class="desc">
								<p><?php echo html_entity_decode($contentData->content); ?></p>
							</div>
							<div class="divider">
								<span></span>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<?php if($canUserSubscribe){ ?>
						<div class="col-md-12">
							@include('businessForm.business_form_11')
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- popups -->
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
	$(document).ready(function(){
		<?php if(!$canUserSubscribe){ ?>
			$("#msg-stopper-for-lower-users").modal({
			  backdrop:"static",
			  keyboard: false
			});

		<?php } ?>
	});

	function showpopup(){
		$('#msg-stopper-for-lower-users').modal('show');
	}
</script>
@endsection