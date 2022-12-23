@extends('layouts.default.app')
@section('content')
<div class="content-area">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8 col-lg-8 content-lft mobLR3">
					<div class="payments_dis_tbl">
						<h3>Mine betalinger</h3>
						<table>
							<tr>
								<th>Køb:</th>
								<th>Beløb:</th>
								<th>Dato:</th>
								<th>Faktura nr.: </th>
							</tr>
							<?php if($invoices == false){								
								?>
								<tr>
									<td colspan="4"><?php echo cmskey('no_payment_found'); ?></td>
								</tr>
							<?php }else{
									foreach($invoices['content'] as $invoice){

									 ?>
									<tr>
										<td>{{$invoice['plan'] == getPlanID('gold') ? getPlanTitle('gold'):getPlanTitle('silver')}}</td>
										<td>{{ceil($invoice['amount_ex_vat']/100)}} kr.</td>										
										<td>{{ $invoice['created']->format('m-d-Y') }}</td>
										<td>inv-{{$invoice['number']}}</td>

									</tr>
									<?php 
									} 
								} ?>															
						</table>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 content-rgt removeMobPadding">
					<div id="network_div">
						<?php $userid = Auth::user()->id; ?>
						<?php  foreach($feed3 as $network){  ?>
                            <div class="single-network-cat-full network_{{$network->id}}">
                                <img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img">
                                <p>{{$network->title}}</p>
                                
                                <a style="display:none" onclick="subscibeToNetwork('{{$network->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$network->id}}_sub">
                                    <div class="text-user-not-subscribed">Bliv medlem</div>
                                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
                                    <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>

                                </a>

                                <a href="javascript:;"  class="tp-right-link" onclick="makeUnscribe('{{$network->id}}');" id="network_{{$network->id}}_unsub">
                                    <div class="text-user-subscribed">Medlem</div>
                                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
                                    <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
                                </a>                            
                            </div>
                            <!-- <div class="single-network-cat-des-full network_{{$network->id}}">
                                <p>
                                    {{shortString($network->details,200)}}
                                </p>
                            </div>                         -->
                        <?php 
                        } ?>
                	</div>
	                <input type="hidden" value="1" id="network_input">
	                <div class="load_more" id="network_load_more">
	                    <a href="{{url('user/loadprofilePages')}}/?option=network&page=2&file=home&user={{$userid}}"><?php echo cmskey('load_more',true) ?></a>
	                    <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="network_img">                                 
	                </div>
	                <div class="clearfix"></div>

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
@include('postjs')
<script type="text/javascript" src="{{asset('js/jquery.jscroll.js?v=1')}}"></script> 
<script>
	function rebindLoading(response){
	    $(this).hide().fadeIn(2000);
	}
	$(document).ready(function(){
	    $.ajaxSetup({
	        headers: { 'X-CSRF-Token' : $('#crf_token').val() }
	    });
	    var path = "{{ asset('img/loading.gif') }}";
	    
	    $('#network_load_more').jscroll({
	           loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
	           padding: 0,
	           callback: rebindLoading,
	           nextSelector: 'a:last'
	        }
	    );
	 });
</script>
@endsection