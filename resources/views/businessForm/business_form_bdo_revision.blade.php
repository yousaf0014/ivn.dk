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
.list-content a{
	color:white;
	text-decoration: underline;
}
.card-content .card-sm-desc{
	display: none;
}
.card-content .ref-link-box .inText {
	display: none;
}
.bad-list-ul {
	list-style: none;
	width: 30%;
	margin: 0 auto;
	margin-left: 40%;
}
.bad-list-ul li {
	color: #fff;
	text-align: left;
	padding: 5px 0;

}
.bad-list-ul li span{
	padding: 5px 5px;
	font-size: 18px;
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
	        					<!-- <img src="{{ asset('uploads/user/' . $business->profile_image) }}" class="img-bdo-logo" alt="bdo logo"> -->
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
<div class="bu-welcome-msg trebuchetMS-font">
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
<div class="cards-bu-loop trebuchetMS-font">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="cards-lists-with-thumb">
					<div class="media-element">
						<!--<iframe width="100%" height="340" src="<?php echo cmskey('bdo_video_link1',true);?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
						<?php echo cmskey('bdo_video_link1');?>
					</div>
					<div class="card-content">
						<div class="card-title">
							<a href="<?php echo cmskey('bdo_video_link1',true);?>"><?php echo cmskey('bdo_video_heading1');?></a>
						</div>
						<div class="card-sm-desc"><?php echo cmskey('bdo_video_time_limit_text1');?></div>
						<div class="card-desc-short">
							<p><?php echo cmskey('bdo_text1');?></p>
						</div>
						<div class="ref-link-box">
							<div class="inText txtleft"><?php echo cmskey('bdo_category1');?></div>
							<div class="inLink btnRight"><a href="{{url('bdo_button_1_link')}}"><?php echo cmskey('bdo_page_link_title1');?></a></div>
						</div>
					</div>
				</div>

				<div class="cards-lists-with-thumb">
					<div class="media-element">
						<?php echo cmskey('bdo_video_link2');?>
					</div>
					<div class="card-content">
						<div class="card-title">
							<a href="<?php echo cmskey('bdo_video_link2',true);?>"><?php echo cmskey('bdo_video_heading2');?></a>
						</div>
						<div class="card-sm-desc"><?php echo cmskey('bdo_video_time_limit_text2');?></div>
						<div class="card-desc-short">
							<p><?php echo cmskey('bdo_text2');?></p>
						</div>
						<div class="ref-link-box">
							<div class="inText txtleft"><?php echo cmskey('bdo_category2');?></div>
							<div class="inLink btnRight"><a href="{{url('bdo_button_2_link')}}"><?php echo cmskey('bdo_page_link_title2');?></a></div>
						</div>
					</div>
					
				</div>

				<div class="cards-lists-with-thumb">
					<div class="media-element">
						<?php echo cmskey('bdo_video_link3');?>
					</div>
					<div class="card-content">
						<div class="card-title">
							<a href="<?php echo cmskey('bdo_video_link3',true);?>"><?php echo cmskey('bdo_video_heading3');?></a>
						</div>
						<div class="card-sm-desc"><?php echo cmskey('bdo_video_time_limit_text3');?></div>
						<div class="card-desc-short">
							<p><?php echo cmskey('bdo_text3');?></p>
						</div>
						<div class="ref-link-box">
							<div class="inText txtleft"><?php echo cmskey('bdo_category3');?></div>
							<div class="inLink btnRight"><a href="{{url('bdo_button_3_link')}}"><?php echo cmskey('bdo_page_link_title3');?></a></div>
						</div>
					</div>
				</div>

				<div class="cards-lists-with-thumb">
					<div class="media-element">
						<?php echo cmskey('bdo_video_link4');?>
					</div>
					<div class="card-content">
						<div class="card-title">
							<a href="<?php echo cmskey('bdo_video_link4',true);?>"><?php echo cmskey('bdo_video_heading4');?></a>
						</div>
						<div class="card-sm-desc"><?php echo cmskey('bdo_video_time_limit_text4');?></div>
						<div class="card-desc-short">
							<p><?php echo cmskey('bdo_text4');?></p>
						</div>
						<div class="ref-link-box">
							<div class="inText txtleft"><?php echo cmskey('bdo_category4');?></div>
							<div class="inLink btnRight"><a href="{{url('bdo_button_4_link')}}"><?php echo cmskey('bdo_page_link_title4');?></a></div>
						</div>
					</div>
					
				</div>

				<div class="cards-lists-with-thumb" style="display:none;">
					<div class="media-element">
						<?php echo cmskey('bdo_video_link5');?>
					</div>
					<div class="card-content">
						<div class="card-title">
							<a href="<?php echo cmskey('bdo_video_link5',true);?>"><?php echo cmskey('bdo_video_heading5');?></a>
						</div>
						<div class="card-sm-desc"><?php echo cmskey('bdo_video_time_limit_text5');?></div>
						<div class="card-desc-short">
							<p><?php echo cmskey('bdo_text5');?></p>
						</div>
						<div class="ref-link-box">
							<div class="inText txtleft"><?php echo cmskey('bdo_category5');?></div>
							<div class="inLink btnRight"><a href="{{url('bdo_button_5_link')}}"><?php echo cmskey('bdo_page_link_title5');?></a></div>
						</div>
					</div>
				</div>

				<div class="cards-lists-with-thumb" style="display:none;">
					<div class="card-content">
						<div class="card-title">
							<a href="<?php echo cmskey('bdo_video_link6',true);?>"><?php echo cmskey('bdo_video_heading6');?></a>
						</div>
						<div class="card-sm-desc"><?php echo cmskey('bdo_video_time_limit_text6');?></div>
						<div class="card-desc-short">
							<p><?php echo cmskey('bdo_text6');?></p>
						</div>
						<div class="ref-link-box">
							<div class="inText txtleft"><?php echo cmskey('bdo_category6');?></div>
							<div class="inLink btnRight"><a href="{{url('bdo_button_6_link')}}"><?php echo cmskey('bdo_page_link_title6');?></a></div>
						</div>
					</div>
					<div class="media-element right-s">
						<?php echo cmskey('bdo_video_link6');?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="clearing"></div>

<div class="bu-frm-content bg-red trebuchetMS-font">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<?php $user = Auth::user(); ?>
				<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
				<form action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm"enctype="multipart/form-data">
					{{ csrf_field() }}
				<?php } ?>
					<?php

					if(Auth::user()->user_subscription == 'level3'){ ?>
						
						<div class="frm-row">
							<div class="list-content">
								<div class="txt-t" style="color:white"><?php echo cmskey('bdo_red_area_heading_1'); ?></div>
								<p style="color:white"><?php echo cmskey('bdo_red_area_text_1'); ?></p>
								<div class="opt-abs-txt">
									<span class="circle" id="red1" onclick="changeRadio('red1');"><input style="display:none;" type="radio" name="red1" id="r_red1" value="1"></span>
									<span class="txt"><a href="javascript:;" onclick="changeRadio('red1');" style="color:white;text-decoration:underline;">Ja tak</a></span>
								</div>
							</div>
							<div class="list-content">
								<div class="txt-t" style="color:white"><?php echo cmskey('bdo_red_area_heading_2'); ?></div>
								<div style="color:white"><p><?php echo cmskey('bdo_red_area_text_2'); ?></p></div>
								<div class="opt-abs-txt">
									<span class="circle"  id="red2" onclick="changeRadio('red2');"><input style="display:none;" type="radio" name="red2" id="r_red2" value="1"></span>
									<span class="txt"><a href="javascript:;" onclick="changeRadio('red2');" style="color:white;text-decoration:underline;">Ja tak</a></span>
								</div>
							</div>
							<?php /*
							<div class="list-content">
								<div class="txt-t" style="color:white"><?php echo cmskey('bdo_red_area_heading_3'); ?></div>
								<div style="color:white"><p style="color:white"><?php echo cmskey('bdo_red_area_text_3'); ?></p></div>
								<div class="opt-abs-txt">
									<span class="circle" id="red3" onclick="changeRadio('red3');"><input style="display:none;" type="radio" name="red3" id="r_red3" value="1"></span>
									<span class="txt"><a href="javascript:;" onclick="changeRadio('red3');" style="color:white;text-decoration:underline;">Ja tak</a></span>
								</div>
							</div>
							*/ ?>
						</div>
					<?php } ?>

					<div class="frm-row" style="display:none">
						<div class="list-content text-center">
							<p style="color:white">
								<div class="" style="color:white; margin-bottom: 10px; font-size:45px;"><?php echo cmskey('bad_list_heading');?></div>
									<ul class="bad-list-ul" style="list-style:none;">
										<li><img src="{{url('images/business-units/ivn_bdo_icon_1.png')}}" height="35"><span><?php echo cmskey('bad_list_li1'); ?></span></li>
										<li><img src="{{url('images/business-units/ivn_bdo_icon_2.png')}}" height="35"><span><?php echo cmskey('bad_list_li2'); ?></span></li>
										<li><img src="{{url('images/business-units/ivn_bdo_icon_3.png')}}" height="35"><span><?php echo cmskey('bad_list_li3'); ?></span></li>
									</ul>
							</p>
							
						</div>
						
					</div>						

					<div class="frm-row" style="display:none">
						<div class="list-content">
							<div class="txt-t" style="color:white"><?php echo cmskey('bdo_pro_text_heading');?></div>
							<p style="color:white"><?php echo cmskey('bdo_pro_text_details');?></p>
							
						</div>
						
					</div>						
					<div class="frm-row">
						<div class="col-sm-10 col-sm-offset-1 mob-padding-no">
							<div class="frm-fld-group bu">
								<label>Virksomhedens Navn:*</label>
								<input type="text" name="name" class="bu-frm-fld" required="true" value="{{$userCompany->name}}">									
							</div>
							<div class="frm-fld-group bu">
								<label>CVR-Nummer:*</label>
								<input type="text" name="cvr" value="{{$userCompany->cvr}}" class="bu-frm-fld" required="true">
							</div>

							<div class="frm-fld-group bu">
								<label>Ejernes navne:*</label>
								<input type="text" name="ejernes" class="bu-frm-fld" required="true" value="{{$user->first_name.' '.$user->last_name}}">
							</div>

							<div class="frm-fld-group bu">
								<label>Telefonnummer:*</label>
								<input type="text" name="telephone" value="{{$user->mobile}}" class="bu-frm-fld" required="true" minlength="8" maxlength="8" number="true">
							</div>

							<div class="frm-fld-group bu">
								<label>E-Mail:*</label>
								<input type="email" name="email" value="{{$user->email}}" readonly="readonly" class="bu-frm-fld" required="true" email="true">
							</div>
							<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
								<div class="frm-fld-group bu text-center">
									<label class="mob-no-height"></label>
									<div class="bu-frm-fld-btn-box">
										<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
										<input type="submit" name="" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','BDO')" value="Send" class="btn bu-btn-wh">
									</div>
								</div>
							<?php }else{ ?>
								<div class="frm-fld-group bu text-center">
									<label class="mob-no-height"></label>
									<div class="bu-frm-fld-btn-box">
										<input type="submit" name="" onclick="showpopup()" value="Send" class="btn bu-btn-wh">
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
					</form>
				<?php } ?>
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
	function changeRadio(fieldName){
		if(!$('#r_'+fieldName).is(':checked')){
			$('#r_'+fieldName).attr('checked','checked');
			$('#'+fieldName).css("background", "#888888");
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
		$('#msg-stopper-for-lower-users').modal('show');
	}
</script>
@endsection