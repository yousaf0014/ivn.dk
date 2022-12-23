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
				<div class="col-md-12">
					<div class="text-center">
                        <div class="links desktop" style="padding-bottom:20px;">
                            <a href="https://ivn.dk/signup" class="btn btn-primary" style="padding-left:100px;padding-right:100px;" tabindex="0">Opret bruger</a>                                            
                        </div>                        
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
<script src="https://token.reepay.com/token.js"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js?v=1')}}"></script> 
<script>
    $(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});    
</script>
@endsection