@extends('layouts.default.app')
<!-- if there are creation errors, they will show here -->
@section('content')

<div class="subscription-2-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<h3>{{cmskey('user_selected_plan_heading')}}:</h3>

				<div class="basis">
					{{getPlanTitle($userSUbscription->plan)}}
				</div>
				<p class="txt-lg line-height-30">
					<?php 
						if($userSUbscription->plan == 'gold'){
							echo !empty($packages[2]) ? html_entity_decode($packages[2]->details) :''; 
						}else if($userSUbscription->plan == 'silver'){
							echo !empty($packages[1]) ? html_entity_decode($packages[1]->details) :'';
						}else{
							echo !empty($packages[0]) ? html_entity_decode($packages[0]->details) :'';
						}
					?>
				</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<h3>{{cmskey('user_update_plan_heading')}}:</h3>
				<div class="pkg-blocks">
					<?php  
					if($userSUbscription->plan == 'silver'){
					?>
					<div class="block centered-align">
						<div class="fancy-radio-button">
							<input type="radio" name="Køn" id="Guld" class="radio-button" onclick="showhide()" >
							<label for="Guld" class="radio-button-click-target" onclick="showhide()">
								<span class="radio-button-circle"></span>
								{{getPlanTitle('gold')}}
							</label>
						</div>
					</div>	
					<div class="popup-buttons text-center margin-top-70">
						<a href="javascript:;" onclick="upgrade()" id="subscribe_button" disabled="disabled" class="btn btn-primary btn-popup">Opgrader nu</a>
					</div>
					<?php } ?>

					<div class="block centered-align">
						<div class="subscription-cancellation">
							<a href="javascript:;" onclick="cancel()">Opsig abonnement</a>
						</div>
					</div>

					<p class="subscription-notes">
						<b><?php echo cmskey('upgrade_plan_under_text_title'); ?></b>
						<span><?php echo cmskey('upgrade_plan_under_text_details'); ?></span>
					</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="unit-ad-post">
					<?php 
					$postData = $businessAd;
                    $post = !empty($businessAd['post']) ? $businessAd['post']:''; 
                    if(!empty($post)){
                    ?>
                    	@include('adview',['post'=>$post,'postData'=>$postData])
                    <?php } ?>
					<!-- <h3>Fabla dette tilbud med Guld</h3>
					<p>
						<b>Få regnskabsprogram gratis med IVN</b>
					</p>
					<div class="image">
						<img src="assets/images/ad-post-image.jpg" alt="" class="img-responsive">
					</div>
					<div class="desc">
						<p class="blue">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">Læs mere</a>
						</p>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	function cancel(){
		sendbuttonTrack1('Tilmeldinger','tilmelding','CancelSubscription');
		if(confirm('{{cmskey("confirm_cancelation_message")}}')){
			window.location= '{{url("cancelPlan")}}';
		}
	}

	$(document).ready(function(){
			
	});

	function showhide(){
		if($('#Guld').is(':checked')){
    		$('#subscribe_button').removeAttr( "disabled");
    	}else{
    		$('#subscribe_button').attr( "disabled", true );
    	}
	}


	function upgrade(){
		if($('#Guld').is(':checked')){
			sendbuttonTrack1('Tilmeldinger','tilmelding','PremiumSubscription');
			window.location = '{{url("upgradePlan")}}';
		}else{
			alert('{{cmskey("please_select_plan")}}');
		}
	}

</script>
@endsection