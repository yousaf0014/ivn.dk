@extends('layouts.default.app')
<!-- if there are creation errors, they will show here -->
@section('content')
<style type="text/css">
	.glyphicon-ok{
		color: green !important;
	}
</style>
<div class="container bg-white">
<div class="content-area-full bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="Subscriptions_new_pkgs">
						<table class=" table-bordered" style="border:0px;">
							<tr>
								<td style="width:25%;border-top:0px;border-left:0px;" class="hidden-xs">
									<div class="circle" style="width: 250px;height: 250px;background-color: #80c0ee;border-radius: 50%;">
										<p class="text-center" style="font-size: 25px; padding-top: 33%; color: #ffffff;">FÅ DE FØRSTE<br>30 DAGE GRATIS<br> <span style="font-size: 12px;">hvis du opretter dig i april</span></p>
									</div>
								</td>
								<td style="width:25%">
									<div class="pkgTitle gray-lighter">{{!empty($packages[0]) ? $packages[0]->title:''}}</div>
									<div class="pkgDesc">
										<?php echo !empty($packages[0]) ? html_entity_decode($packages[0]->details):''; ?>
									</div>
									<div class="pkgPrice">
										<div class="pkgPVal">
											Gratis
										</div>
										<div class="price_desc">&nbsp;</div>
									</div>
									<div class="pkgSubscribe"><a href="JavaScript:void(0)" class="btn btn-primary" style="background:#fff;border-color:#fff;color:#333">&nbsp;</a></div>
									<div class="chckpolicy">
										<div class="fancy-checkbox">
											<input style="display:none;" type="checkbox" onclick="changeaccess('checkbox-2','basic')" class="checkbox" id="checkbox-2">
											<label style="display:none;" for="checkbox-2" onclick="changeaccess('checkbox-2','basic')" class="checkbox-click-target sm"><span class="checkbox-box"></span>
												Ja, jeg <a href="javascript:;" style="text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">accepterer.</a>
											</label>
										</div>
									</div>	
									<div class="pkg_after_btn_text visible-xs">{{!empty($packages[0]) ? $packages[0]->title:''}}</div>
									<div class="visible-xs for_mob">
										<?php foreach($options as $option){ ?>
											<div class="pt-item">
												<div class="img-tick">
													<span class="glyphicon glyphicon-{{$option->basic == 1 ? 'ok':'remove'}}"></span>
												</div>
												<div class="txt"><?php echo $option->text?></div>
												<span  class="info-right">
													<i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="<?php echo $option->details?>"></i>
												</span>
											</div>
										<?php } ?>
									</div>
								</td>
								<td style="width:25%">
									<div class="pkgTitle gray-dk-light">{{!empty($packages[1]) ? $packages[1]->title:''}}</div>
									<div class="pkgDesc">
										<?php echo !empty($packages[1]) ? html_entity_decode($packages[1]->details):''; ?>
									</div>
									<div class="pkgPrice">
										<div class="pkgPVal"><?php echo !empty($packages[1]) ? html_entity_decode($packages[1]->price):''; ?><sub>kr</sub></div>
										<div class="price_desc">(Excl. moms)</div>
									</div>
									<div class="pkgSubscribe">
										<a href="javascript:;" disabled="disabled" id="silver_a" class="btn btn-primary submit-form">Vælg {{!empty($packages[1]) ? $packages[1]->title:''}}</a>
									</div>
									<div class="chckpolicy">
										<div class="fancy-checkbox">
											<input type="checkbox" onclick="changeaccess('checkbox-3','silver')"  class="checkbox" id="checkbox-3">
											<label for="checkbox-3" onclick="changeaccess('checkbox-3','silver')"  class="checkbox-click-target sm"><span class="checkbox-box"></span>
												Jeg accepterer <a href="javascript:;" style="text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">abonnementsbetingelserne.</a>
											</label>
										</div>
									</div>								

									<div class="pkg_after_btn_text visible-xs">{{!empty($packages[1]) ? $packages[1]->title:''}}</div>
									<div class="visible-xs for_mob">
										<?php foreach($options as $option){ ?>
											<div class="pt-item">
												<div class="img-tick">
													<span class="glyphicon glyphicon-{{$option->silver == 1 ? 'ok':'remove'}}"></span>
												</div>
												<div class="txt"><?php echo $option->text?></div>
												<span  class="info-right">
													<i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="<?php echo $option->details?>"></i>
												</span>
											</div>
										<?php } ?>
									</div>
								</td>
								<td style="width:25%">
									<div class="pkgTitle gray-dk">{{!empty($packages[2]) ? $packages[2]->title:''}}</div>
									<div class="pkgDesc">
										<?php echo !empty($packages[2]) ? html_entity_decode($packages[2]->details):''; ?>
									</div>
									<div class="pkgPrice">
										<div class="pkgPVal"><?php echo !empty($packages[2]) ? html_entity_decode($packages[2]->price):''; ?><sub>kr</sub></div>
										<div class="price_desc">(Excl. moms)</div>
									</div>
									
									<div class="pkgSubscribe">
										<a href="javascript:;" disabled="disabled" id="gold_a" class="btn btn-primary submit-form">Vælg {{getPlanTitle('gold')}}</a>
									</div>
									<div class="chckpolicy">
										<div class="fancy-checkbox">
											<input type="checkbox" onclick="changeaccess('checkbox-4','gold')"  class="checkbox" id="checkbox-4">
											<label for="checkbox-4" onclick="changeaccess('checkbox-4','gold')"  class="checkbox-click-target sm"><span class="checkbox-box"></span>
												Jeg accepterer <a href="javascript:;" style="text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">abonnementsbetingelserne.</a>
											</label>
										</div>
									</div>

									<div class="pkg_after_btn_text visible-xs">{{!empty($packages[2]) ? $packages[2]->title:''}}</div>
									<div class="visible-xs for_mob">
										<?php foreach($options as $option){ ?>
											<div class="pt-item">
												<div class="img-tick">
													<span class="glyphicon glyphicon-{{$option->gold == 1 ? 'ok':'remove'}}"></span>
												</div>
												<div class="txt"><?php echo $option->text?></div>
												<span  class="info-right">
													<i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="<?php echo $option->details?>"></i>
												</span>
											</div>
										<?php } ?>
									</div>
								</td>
							</tr>

							<?php foreach($options as $option){ ?>
								<tr class="hidden-xs">
									<td class="pt-desc with-info"><?php echo $option->text;?>
										<span  class="info-right">
											<i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="<?php echo $option->details;?>"></i>
										</span></td>
									<td class="pt-desc"><div class="img-tick"><span class="glyphicon glyphicon-{{$option->basic == 1 ? 'ok':''}}"></span></div></td>
									<td class="pt-desc"><div class="img-tick"><span class="glyphicon glyphicon-{{$option->silver == 1 ? 'ok':''}}"></span></div></td>
									<td class="pt-desc"><div class="img-tick"><span class="glyphicon glyphicon-{{$option->gold == 1 ? 'ok':''}}"></span></div></td>
								</tr>

							<?php } ?>
						</table>

						<div class="clearfix"></div>
						<div class="bottom_desc">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<div style="display:none">
	<form id="signupform" method="post" action="{{url('subscription')}}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="hidden" name="first_name" value="{{Auth::user()->first_name}}" required placeholder="First name" />
        <input type="hidden" name="last_name" value="{{Auth::user()->last_name}}" required placeholder="Last name" />
        <input type="hidden" name="email" value="{{Auth::user()->email}}" required />
        <input type="checkbox" id="terms" checked="checked" required/>
        <input type="hidden" id="token" name="reepay-token"/>
        <input type="submit" id="submit-form" style="display:none;"/>
        <input type="hidden" name="customer" value="cut_{{Auth::user()->id}}">
		<input type="hidden" name="plan" value="{{getPlanID("silver")}}" id="planID">   
		<input type="hidden" name="plan_name" value="basic" id="planName">                
    </form>
</div>
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
                                   <h2 class="text-white"><?php echo cmskey('payment_term_conditions_title');?></h2>
                                    <?php echo cmskey('payment_term_conditions_details');?>
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
<script src="https://token.reepay.com/token.js"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js?v=1')}}"></script> 
<script>
    $(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});
    var form = document.getElementById('signupform');
    var handler = reepaytoken.configure({
        key: 'pub_89adef5af8474bf87ba31ab493bd7d75',
        language: 'da',
        recurring: true,
        token: function(result) {
            console.log(JSON.stringify(result));
            document.querySelector('#token').value = result.token;

            $('#submit-form').click();
        },
        ready: function() {
        	//document.querySelector('#signup-button').removeAttribute('disabled');                
        },
        close: function() {
            console.log('modal closed');
        }
    });

    function putplanId(plan){
    	if(plan == 'silver'){
    		$('#planID').val('{{getPlanID("silver")}}');
    		$('#planName').val('silver');
    		sendbuttonTrack1('Tilmeldinger','tilmelding','ProSubscription');
    	}else{
    		$('#planID').val('{{getPlanID("gold")}}');
    		$('#planName').val('gold');
    		sendbuttonTrack1('Tilmeldinger','tilmelding','PremiumSubscription');
    	}
    	handler.open();
    }

    function changeaccess(elem,name){
    	if($('#'+elem).is(':checked')){
    		$('#'+name+'_a').removeAttr( "disabled");
    		$('#'+name+'_a').attr( "onclick", 'putplanId("'+name+'")');
    	}else{
    		$('#'+name+'_a').attr( "onclick", 'return false;');
    		$('#'+name+'_a').attr( "disabled", true );
    	}
    }
</script>
@endsection