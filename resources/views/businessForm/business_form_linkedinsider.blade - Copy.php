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
<div id="main-body" class="bg-white">		
	<!-- Slider Image Section -->

	<section id="slider" class="bg-white">
		<img class="img-responsive" src="{{asset('user_images/'.$contentData->image_path)}}">
	</section>

	<section id="main-content" class="py-5 bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="my-5"><?php echo $contentData->title; ?></h2>
					<p class="px-5 pb-3"><?php echo html_entity_decode($contentData->content); ?></p>
					<div class="border-bottom"></div>
					<h1 class="my-5 pb-3"><?php echo cmskey('linkedinsider_video_heading');?></h1>
					<div class="youtube-vid">
						<?php echo cmskey('linkedinsider_video_link1');?>
						<!-- <iframe src="https://www.youtube.com/embed/FQ4ijsBxBbA?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="textbox" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-1">
					<p class="text-orange"><?php echo cmskey('linkedinsider_textarea_heading1');?></p>
					<p class="text-white"><?php echo cmskey('linkedinsider_textarea_white_color_text');?>
					</p>
					<p class="text-orange py-5">
						<?php echo cmskey('linkedinsider_textarea_orange_color_text');?>
					</p>
					<p class="text-white"><?php echo cmskey('linkedinsider_textarea_white_color_text2');?></p>
				</div>
			</div>
		</div>
	</section>

	<section id="signup" class="py-5 bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php $user = Auth::user();?>
					<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm" enctype="multipart/form-data">
						<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
						{{ csrf_field() }}			
						<div class="form-group">
							<label for="name">Hvilken dato vil du på kursus:</label>
							<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
								echo 'CMS key name for options is:linkedinsider_form1_options.<br/><b>Please provide "," seprated values for this key in backend like val1,val2,val3,...</b>';

							}?>
							<?php $options = explode(',',cmskey('linkedinsider_form1_options','true'));?>
							<select name="kursus" class="selectpicker form-control" required="true">
								<?php foreach($options as $opt){?>
									<option value="{{$opt}}">{{$opt}}</option>
								<?php } ?>
							</select>
						
						</div>
						<div class="form-group">
							<label for="navn">Navn:</label>
							<input type="name" name="navn" class="form-control"  placeholder="Navn" required="true" value="{{$user->first_name.' '.$user->last_name}}">
						</div>
						<div class="form-group">
							<label for="email">E-mail:</label>
							<input type="email" class="form-control" name="email"  required="true" email="true" value="{{$user->email}}">
						</div>
						<div class="text-center py-5">
							<button type="submit" class="btn btn-default w-100">Tilmeld mig</button>
						</div>
					</form>
					<div class="w-70 mx-auto pt-5">
						<p class="p-lineheight">
							<?php echo cmskey('linkedinsider_bottom_text');?>							
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
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
<link href="{{asset('css/linkeninsider_style.css')}}" rel="stylesheet" type="text/css">
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