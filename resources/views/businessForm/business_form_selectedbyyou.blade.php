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
<div id="body-container" class="bg-white">
	<section class="main-banner bg-white">
		<img class="img-responsive" src="{{asset('user_images/'.$contentData->image_path)}}">
	</section>

	<section class="content-area  bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center"><?php echo $contentData->title; ?></h3>
					<p class="text-center pt-5"><?php echo html_entity_decode($contentData->content); ?></p>
				</div>
			</div>
		</div>
	</section>

	<div class="mx-auto border-btm"></div>

	<section class="boxes-area  bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- First col-md-6 -->
					<div class="col-lg-6">
						<div class="left-box">
							<h3 class="text-center"><?php echo cmskey('selectedByYou_form1_heading');?></h3>
							<p class="text-center"><?php echo cmskey('selectedByYou_form1_text');?></p>
							<?php $user = Auth::user();?>
							<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>				
							<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm" enctype="multipart/form-data">
								<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
								{{ csrf_field() }}								
							<?php }else{ ?>
								<form class="form-horizontal">
							<?php } ?>
								<div class="form-group">
									<label class="control-label col-sm-2" for="name">Navn:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="name" required="true" value="{{$user->first_name.' '.$user->last_name}}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="email">Email:</label>
									<div class="col-sm-10">
										<input type="email" class="form-control" name="email"  required="true" email="true" value="{{$user->email}}" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="phone">Telefon:</label>
									<div class="col-sm-10">
										<input type="tel" class="form-control" name="phone" required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}"> 
									</div>
								</div>
								<?php /* <div class="form-group">
									<label class="control-label col-sm-2" for="phone">Kursusdato:</label>
									<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
										echo 'CMS key name for options is:selectedByYou_form1_options.<br/><b>Please provide "," seprated values for this key in backend like val1,val2,val3,...</b>';

									}?>
									<?php $options = explode(',',cmskey('selectedByYou_form1_options','true'));?>
									<div class="col-sm-10">
										<select name="kursusdato" class="selectpicker form-control" required="true">
											<?php foreach($options as $opt){?>
												<option value="{{$opt}}">{{$opt}}</option>
											<?php } ?>
										</select>
									</div>
								</div>
								*/ ?>
							<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
								<div class="text-center">
									<input type="hidden" name="email_title" value="Sparring">
									<button type="button" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','SelectedByYou');$('#businessForm').submit();">SEND</button>
								</div>							
							<?php }else{ ?>
								<div class="text-center">
									<button type="button" onclick="showpopup()">SEND</button>
								</div>
							<?php } ?>
							</form>
						</div>
					</div>
					<!-- Second col-md-6 -->
					<div class="col-lg-6">
						<div class="right-box">
							<h3 class="text-center"><?php echo cmskey('selectedByYou_form2_heading');?></h3>
							<p class="text-center"><?php echo cmskey('selectedByYou_form2_text');?></p>
							<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
							<form class="form-horizontal" action="{{url('saveuserBusiness',$contentData->content_for)}}" method="post" id="businessForm2" enctype="multipart/form-data">
							
								<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
								{{ csrf_field() }}
							<?php }else{ ?>
								<form class="form-horizontal">
							<?php } ?>
								<div class="form-group">
									<label class="control-label col-sm-2" for="name">Name:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control"name="name" required="true" value="{{$user->first_name.' '.$user->last_name}}">
									</div>
									
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="email">Email:</label>
									<div class="col-sm-10">
										<input type="email" class="form-control"  name="email" required="true" email="true" value="{{$user->email}}" readonly="readonly">
									</div>
									
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="phone">Telefon:</label>
									<div class="col-sm-10">
										<input type="tel" class="form-control" name="phone" required="true" minlength="8" maxlength="8" number="true" value="{{$user->mobile}}">
									</div>
									
								</div>
								<?php /* <div class="form-group">
									<?php if(!empty(Auth::user()) && \Auth::user()->user_type == 'admin'){
										echo 'CMS key name for options is:selectedByYou_form2_options.<br/><b>Please provide "," seprated values for this key in backend like val1,val2,val3,...</b>';

									}?>
									<?php $options1 = explode(',',cmskey('selectedByYou_form2_options','true'));?>
									
									<label class="control-label col-sm-2" for="phone">Uge:</label>
									<div class="col-sm-10">
										<select name="uge" class="selectpicker form-control">
											<?php foreach($options1 as $opt){ ?>
												<option value="{{$opt}}">{{$opt}}</option>
											<?php } ?>
										</select>
									</div>
								</div> */ ?>
							<?php if(!empty(Auth::user()) && \Auth::user()->user_subscription != 'level1'){ ?>
								<div class="text-center">
									<input type="hidden" name="email_title" value="Kursus">
									<button type="button" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','SelectedByYou');$('#businessForm2').submit();">SEND</button>
								</div>							
							<?php }else{?>
								<div class="text-center">
									<button type="button" onclick="showpopup()">SEND</button>
								</div>
							<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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

@endsection
@section('scripts')
<link href="{{asset('css/selected_by_you_style.css?v=1')}}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
	$(document).ready(function(){
		$("#businessForm").validate();
		$('#businessForm2').validate();	
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