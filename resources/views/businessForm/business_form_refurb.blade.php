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
		echo 'CMS key name for refurb email code is:refurb_email_code.<br/><b>this code will be sent in email.</b>';

	}?>
</div>
<div class="clearing"></div>
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
		 $('#msg-stopper-for-lower-users').modal('show'); 
	}
</script>
@endsection