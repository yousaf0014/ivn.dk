@extends('layouts.default.app')
<!-- if there are creation errors, they will show here -->
@section('content')

<div class="subscription-plan-mob">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<table>
					<tr>
						<td width="33.33%" style="text-align:center;">
							<h3>{{!empty($packages[0]) ? $packages[0]->title:''}}</h3>

						</td>
						<td width="33.33%" style="text-align:center;">
							<h3>{{!empty($packages[1]) ? $packages[1]->title:''}}</h3>

						</td>
						<td width="33.33%" style="text-align:center;">
							<h3>{{!empty($packages[2]) ? $packages[2]->title:''}}</h3>
						</td>
					</tr>
					<tr>
						<td style="text-align:left;">
							<?php echo !empty($packages[0]) ? html_entity_decode($packages[0]->details):''; ?>
						</td>
						<td style="text-align:left;">
							<?php echo !empty($packages[1]) ? html_entity_decode($packages[1]->details):''; ?>
						</td>
						<td style="text-align:left;">
							<?php echo !empty($packages[2]) ? html_entity_decode($packages[2]->details):''; ?>
						</td>
					</tr>
					<tr>
						<td>
							<div class="price"><?php echo !empty($packages[0]) ? html_entity_decode($packages[0]->price):''; ?> kr. <small>(Excl. moms)</small></div>
						</td>
						<td>
							<div class="price"><?php echo !empty($packages[1]) ? html_entity_decode($packages[1]->price):''; ?> kr. <small>(Excl. moms)</small></div>
						</td>
						<td>
							<div class="price"><?php echo !empty($packages[2]) ? html_entity_decode($packages[2]->price):''; ?> kr. <small>(Excl. moms)</small></div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="btn-block">
								<a href="javascript:;" disabled="disabled" class="btn btn-primary">Opret profil</a>
							</div>
							<!-- <div class="fancy-checkbox">
								<input type="checkbox" class="checkbox" id="checkbox-2">
								<label for="checkbox-2" class="checkbox-click-target sm"><span class="checkbox-box"></span>
									Ja, jeg accepterer brugerbetingelserne og at modtage nyhedsbreve fra IVN.
								</label>
							</div> -->
						</td>

						<td>
							<div class="btn-block">
								<div class="btn-block">
									<a href="javascript:;" disabled="disabled" onclick="putplanId('silver')" id="silver_a" class="btn btn-primary submit-form">Opret profil</a>
								</div>
								<div class="fancy-checkbox">
									<input type="checkbox" onclick="changeaccess('checkbox-3','silver')" class="checkbox" id="checkbox-3">
									<label for="checkbox-3" onclick="changeaccess('checkbox-3','silver')" class="checkbox-click-target sm"><span class="checkbox-box"></span>
										Ja, jeg <a href="javascript:;" style="text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">accepterer.</a>
									</label>
								</div>								
							</div>							
						</td>
						<td>
							<div class="btn-block">
								<div class="btn-block">
									<a href="javascript:;" disabled="disabled" onclick="putplanId('gold')" id="gold_a" class="btn btn-primary submit-form">Opret profil</a>
								</div>
								<div class="fancy-checkbox">
									<input type="checkbox" onclick="changeaccess('checkbox-4','gold')"  class="checkbox" id="checkbox-4">
									<label for="checkbox-4" onclick="changeaccess('checkbox-4','gold')"  class="checkbox-click-target sm"><span class="checkbox-box"></span>
										Ja, jeg <a href="javascript:;" style="text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">accepterer.</a>
									</label>
								</div>
							</div>							
						</td>
					</tr>
				</table>
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
<script>
    var form = document.getElementById('signupform');
    var handler = reepaytoken.configure({
        key: 'pub_89adef5af8474bf87ba31ab493bd7d75',
        language: 'en',
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
    	}else{
    		$('#planID').val('{{getPlanID("gold")}}');
    		$('#planName').val('gold');
    	}
    	handler.open();
    }

    function changeaccess(elem,name){
    	if($('#'+elem).is(':checked')){
    		$('#'+name+'_a').removeAttr( "disabled");
    	}else{
    		$('#'+name+'_a').attr( "disabled", true );
    	}
    }
</script>
@endsection