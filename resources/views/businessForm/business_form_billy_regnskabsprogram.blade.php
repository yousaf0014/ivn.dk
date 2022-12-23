@extends('layouts.default.app')
@section('content')
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
	<div class="clearing"></div>
	<div class="bu-welcome-msg">
		<div class="container">
			<div class="row">
				<dic class="col-sm-8 col-sm-offset-2">
					<h1><?php echo $contentData->title; ?></h1>
					<p>
						<?php echo html_entity_decode($contentData->content); ?>
					</p>
					<div class="clearing"></div>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<hr class="style-black">
						</div>
					</div>
				</dic>
			</div>
		</div>
	</div>
	<div class="clearing"></div>
	<div class="bu-points bg-white padding-bottom-40">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h3 class="ptheading" style="text-align:center"><?php echo cmskey('bill_icons_heading');?></h3>
				</div>
				<div class="clearing"></div>
				<div class="col-sm-8 col-sm-offset-2">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="row">
								<div class="col-xs-offset-4 col-sm-6 col-xs-6">
									<div class="icon-w-txt-h">
										<div class="ic"><img src="{{asset('images/business-units/check_box.png')}}" alt="Send fakturaer"></div>
										<div class="txt"><?php echo cmskey('billy_list_key_1');?></div>
									</div>
									<div class="icon-w-txt-h">
										<div class="ic"><img src="{{asset('images/business-units/check_box.png')}}" alt="Registrer regninger"></div>
										<div class="txt"><?php echo cmskey('billy_list_key_2');?></div>
									</div>
									<div class="icon-w-txt-h">
										<div class="ic"><img src="{{asset('images/business-units/check_box.png')}}" alt="Afregn moms"></div>
										<div class="txt"><?php echo cmskey('billy_list_key_3');?></div>
									</div>
									<div class="icon-w-txt-h">
										<div class="ic"><img src="{{asset('images/business-units/check_box.png')}}" alt="Send abonnements fakturaer"></div>
										<div class="txt"><?php echo cmskey('billy_list_key_4');?></div>
									</div>
									<div class="icon-w-txt-h">
										<div class="ic"><img src="{{asset('images/business-units/check_box.png')}}" alt="Bogfør fra din smartphone"></div>
										<div class="txt"><?php echo cmskey('billy_list_key_5');?></div>
									</div>
									<div class="icon-w-txt-h">
										<div class="ic"><img src="{{asset('images/business-units/check_box.png')}}" alt="Mere end 60 integrationer"></div>
										<div class="txt"><?php echo cmskey('billy_list_key_6');?></div>
									</div>
								</div>
								<div class="col-sm-7 col-xs-6">
									<div class="pt-details">
										<?php //echo cmskey('bill_icons_details');?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearing"></div>
	<div class="bu-frm-dk-2 bg-blue">
		<div class="col-sm-8 col-sm-offset-2">
			<h2><?php echo cmskey('bill_form_heading');?></h2>
			<p style="text-align:center"><?php echo cmskey('bill_form_details');?></p>
			<div class="clearfix"></div>
			<div class="row">
				<?php $user = Auth::user();?>
				<div class="col-sm-8 col-sm-offset-2">
					<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
					<form class="frm-with-rounded-flds"action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm"enctype="multipart/form-data">
					<?php }else{?>
						<form class="frm-with-rounded-flds">
					<?php } ?>	
						{{ csrf_field() }}
						<div class="frm-grp">
							<label>E-Mail*</label>
							<input type="email" name="email" value="{{$user->email}}" class="rounded-fld" required="true" email="true" readonly="readonly" >
						</div>
						<div class="frm-grp">
							<label>Vælg adgangskode*</label>
							<input type="text" name="adgangskode" value="" class="rounded-fld" required="true">
						</div>
						<div class="frm-grp">
							<label>Dit navn*</label>
							<input type="text" name="Dit" value="{{$user->first_name.' '.$user->last_name}}" class="rounded-fld" required="true">
						</div>
						<div class="frm-grp">
							<label>Virksomhedens navn*</label>
							<input type="text" name="Virksomhedens" value="{{$userCompany->name}}" class="rounded-fld" required="true">
						</div>
						<div class="frm-grp">
							<label>Land*</label>
							<select name="country" class="rounded-fld" required="true">
								<?php foreach($countries as $id=>$con){ ?>
									<option value="{{$con->name}}" <?php echo $id === $user->country ? 'selected="selected"':'';?>>{{$con->name}}</option>
								<?php } ?>
							</select>
						</div>
						<div class="frm-grp">
							<label>Telefon*</label>
							<input type="text" name="phone" value="{{$user->mobile}}" class="rounded-fld" required="true" minlength="8" maxlength="8" number="true">
						</div>
						<div class="frm-grp">
							<div class="cstm-chk-box-rounded-style">
								<div class="inline-block">
									<input type="checkbox" id="box-1" name="accepty" onclick="changeaccess('box-1')">
									<label for="box-1">Jeg acceptererBilly ApS'  <a href="javascript:;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">generelle betingelser</a></label>
								</div>
							</div>
						</div>
						<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
					
						<div class="frm-grp">
							<div class="text-center">
								<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
								<input type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','ErhvervsakademiDania')" id="submit_button" disabled="disabled" class="btn btn-submit" value="Opret gratis Billy-bruger">
							</div>
						</div>
					<?php }else{?>
						<div class="frm-grp">
							<div class="text-center">
								<input type="button" onclick="showpopup()" id="submit_button" disabled="disabled" class="btn btn-submit" value="Opret gratis Billy-bruger">
							</div>
						</div>
					<?php } ?>
					</form>
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
                                <a href="javascript:;" onclick="$('#welcome').modal('hide');" class="btn btn-primary btn-popup min-width-300">Ikke nu</a>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
	
	function changeaccess(button){
		if($('#box-1').is(":checked")){
			$('#submit_button').removeAttr('disabled');
		}else{
			$('#submit_button').attr('disabled','disabled');
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