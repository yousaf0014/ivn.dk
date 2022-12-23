@extends('layouts.default.app')
@section('content')
<div class="business-unit-slider">
	<div id="slider-Ehrvervsakademi-Dania" class="carousel slide" data-ride="carousel">
	  	<!-- Wrapper for slides -->
	  	<div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="{{asset('user_images/'.$contentData->image_path)}}" alt="Ehrvervsakademi-Dania slider image" class="img-responsive img-bu-slider">
				<div class="carousel-caption">
				 	<div class="container pos-relative f-height">
						<div class="logo-bu-right">
			    			 	<!-- <img src="{{ asset('uploads/user/'.$business->profile_image) }}" alt="dania-logo"> -->
			    			 </div>
						 <div class="row f-height">
						 	<div class="col-md-12 f-height">
						 		<div class="vm-layout">
						 			<div class="vm-layout-content">
						 				<!-- <h2 class="light-text style3 no-shadow ">{{$contentData->image_title}}</h2> -->
						 			</div>
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

<div class="bu-welcome-msg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="style-bold"><?php echo $contentData->title; ?></h1>
				<p>
					<?php echo html_entity_decode($contentData->content); ?>
				</p>
				<div class="clearing"></div>
			</div>
		</div>
	</div>
</div>
<div class="clearing"></div>
<div class="points-with-tabs bg-white">
	<div class="container">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="row">
			<div class="bu-tabs style-red">
				<!-- Nav tabs -->
				  <ul class="nav nav-tabs nav-justified" role="tablist">
				    <li class="active">
					    <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><?php echo cmskey('erhavervsakademi_dania_tab1'); ?></a>
				    </li>
				    <li role="presentation">
					    <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?php echo cmskey('erhavervsakademi_dania_tab2'); ?></a>
				    </li>
				    <li role="presentation">
					    <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><?php echo cmskey('erhavervsakademi_dania_tab3'); ?></a>
				    </li>
				    <li role="presentation" class="">
					    <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><?php echo cmskey('erhavervsakademi_dania_tab4'); ?></a>
				    </li>
				  </ul>
				  <!-- Tab panes -->
				  	<div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="tab1">
					    		<div class="dania-tab-with-right-img-content" style="background:url('{{ asset('images/business-units/img-girl-thinking.jpg') }}') no-repeat bottom right #fff;">
								<div class="txt">
									<h4><?php echo cmskey('erhavervsakademi_dania_tab1_heading');?></h4>
									<p><?php echo cmskey('erhavervsakademi_dania_tab1_text');?></p>
								</div>
					    		</div>
					    </div>
					    <div role="tabpanel" class="tab-pane" id="tab2">
					    	<div class="dania-tab-with-right-img-content" style="background:url('{{ asset('images/business-units/another-girl.png') }}') no-repeat bottom right #fff;">
						    	<div class="txt">
						    		<p><?php echo cmskey('erhavervsakademi_dania_tab2_text');?></p>
						    	</div>
						    </div>
					    </div>
					    <div role="tabpanel" class="tab-pane" id="tab3">
					    	<div class="dania-tab-with-right-img-content" style="background:url('{{ asset('images/business-units/img-girl-thinking.jpg') }}') no-repeat bottom right #fff;">
					    		<div class="txt">					    	
					    			<p><?php echo cmskey('erhavervsakademi_dania_tab3_text');?></p>
					    		</div>
					    	</div>
					    </div>
					    <div role="tabpanel" class="tab-pane" id="tab4">
					    	<div class="dania-tab-with-right-img-content" style="background:url('{{ asset('images/business-units/another-girl.png') }}') no-repeat bottom right #fff;">
						    	<div class="txt">				    	
						    		<p><?php echo cmskey('erhavervsakademi_dania_tab4_text');?></p>
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

<div class="fixed-with-contacting-box">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box-contacting style-red style-dark">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<h2><?php echo cmskey('erhavervsakademi_dania_form_heading');?></h2>
							<p><?php echo cmskey('erhavervsakademi_dania_form_details');?></p>
							<?php $user = Auth::user();?>
							<form action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-xs-12  col-sm-8 col-sm-offset-2">
										<div class="frm-grp">
											<div class="col-xs-12 col-sm-6 label-txt">Navn:</div>
											<div class="col-xs-12 col-sm-6 fld-box">
												<input type="text" name="name" class="fld-ctnt" required="true" value="{{$user->first_name.' '.$user->last_name}}">
											</div>
										</div>
										<div class="frm-grp">
											<div class="col-xs-12 col-sm-6 label-txt">E-mail:</div>
											<div class="col-xs-12 col-sm-6 fld-box">
												<input type="email" name="email" class="fld-ctnt" required="true" email="true" value="{{$user->email}}" readonly="readonly">
											</div>
										</div>
										<div class="frm-grp">
											<div class="col-xs-12 col-sm-6 label-txt">Telefonnummer:</div>
											<div class="col-xs-12 col-sm-6 fld-box">
												<input type="text" name="telephone" class="fld-ctnt" required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}">
											</div>
										</div>
									</div>
								</div>

								<div class="row radiosboxes">
									<div class="col-sm-4 col-xs-12">
										<div class="cstm-chk-box-rounded-style">
											<div class="inline-block">
												<input type="checkbox" id="box-1" name="option1" class="radio" value="Iværksætteri i praksis">
												<label for="box-1" class="font-light">Iværksætteri i praksis</label>
											</div>
										</div>
									</div>
									<div class="col-sm-4 col-xs-12">
										<div class="cstm-chk-box-rounded-style">
											<div class="inline-block">
												<input type="checkbox" id="box-2" name="option2" class="radio"  value="Vækst, innovation og forretning">
												<label for="box-2" class="font-light">Vækst, innovation og forretning</label>
											</div>
										</div>
									</div>
									<div class="col-sm-4 col-xs-12">
										<div class="cstm-chk-box-rounded-style">
											<div class="inline-block">
												<input type="checkbox" id="box-3" name="option3" class="radio" value="Anvendt økonomi">
												<label for="box-3" class="font-light">Anvendt økonomi</label>
											</div>
										</div>
									</div>
								</div>

								<div class="frm-grp text-center">
									<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
									<input type="button" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','ErhvervsakademiDania');submitUserForm()" value="Send mig mere info" class="btn btnSubmt">
								</div>
							</form>
						</div>
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

<!-- popups -->
<div class="modal fade ivn-popups" id="term_and_condition" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
        <div class="vm-layout">
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="modal-content style-black no-border-radius no-shadow no-border no-padding-top ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                            <img src="{{asset('images/white_close.png')}}" alt="close">
                        </button>
                        <div class="modal-body ">
                            <div class="body-with-scroll">
                                <div class="col-lg-10 col-lg-offset-1 clear-before-after text-white">
                                   <h2 class="text-white"><?php echo cmskey('billy_terms_conditions_heading');?></h2>
                                    <?php echo cmskey('billy_terms_heading_term_conditions_details');?>
                                </div>                          
                            </div>
                            <div class="clearfix"></div>
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
	function submitUserForm(){
        var flag = $('#businessForm').valid();
        if(flag == true){
            if($('.radio:checked').length > 0){
                $('#businessForm').submit();
            }else{
                alert('<?php echo cmskey("course_select_message",true); ?>');
                return false;
            }
        }
        return false;
    }
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
		/* $('#msg-stopper-for-lower-users').modal('show'); */
	}
</script>
@endsection