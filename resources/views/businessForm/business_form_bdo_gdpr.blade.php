@extends('layouts.default.app')
@section('content')

<div id="main-body">
	<!-- Main Image Area -->
	<section class="main-img bg-white" style="background-image: url('{{asset('user_images/'.$contentData->image_path)}}');"></section>

	<!-- First content Area -->
	<section class="first-content bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center"><?php echo $contentData->title; ?></h2>
					<p class="text-center py-4 px-5"><?php echo html_entity_decode($contentData->content); ?></p>
				</div>
			</div>
		</div>
		<div class="mx-auto border-btm"></div>
	</section> 

	<!-- Second Content Area -->
	<section class="second-content bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="text-center"><?php echo cmskey('gdpr_main_area1_text');?></p>
					<h3 class="text-center"><?php echo cmskey('gdpr_main_area1_heading');?></h3>
					<p class="text-center"><?php echo cmskey('gdpr_main_area2_text');?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="last-area  bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<p class="text-center pt-5"><?php echo cmskey('read_more_text'); ?></p>
					<button type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','gdpr');readmoreWindow()" class="btn bg-primary">Ja tak, jeg vil gerne have styr på GDPR</button>
				</div>
			</div>
		</div>
	</section>
	<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
		echo 'CMS key name for gdpr email code is:gdpr_emailcode_premium / gdpr_email_code_pro.<br/><b>this code will be sent in email.</b>';

	}?>
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
<?php if(!empty(Auth::user()) && Auth::user()->user_subscription == 'level3'){ ?>
	<div style="display:none;">
		<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm">
			<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
			{{ csrf_field() }}	
		</form>
	</div>
<?php } ?>

@endsection
@section('scripts')
<link href="{{asset('css/gdpr_style.css?v=1')}}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
	function readmoreWindow(){
		<?php if(!empty(Auth::user()) && Auth::user()->user_subscription == 'level3'){ ?>
				$('#businessForm').submit();
		<?php }else{?>
			$('#msg-stopper-for-lower-users').modal('show');
		<?php } ?>
		//window.open('http://ivn.gdpr.dk','_blank');
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