@extends('layouts.default.app')
@section('content')
<!-- category landing page start -->
	<div class="category-landing-top" style="background-image:url({{ asset('uploads/category/'.$categoryData->image_path) }});">
		<div class="blue-bg overlay" style="">
			<div class="container full-height">
				<div class="row full-height">
					<div class="col-md-12 full-height">
						<h1 class="cat-title">{{$categoryData->title}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div class="network-landing-desc category-landing-desc">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>
						<?php  echo html_entity_decode($categoryData->details); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="network-listing">
		<div class="container">
			<div class="row">
				<?php foreach($categoryData->network as $network){ ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="single-ivn-post">
						<div class="single-network-cat-full ">
							<a href="{{url('network/'.$network->url)}}"><img src="{{ asset('uploads/network/thumb_'.$network->image_path) }}" alt="img"></a>
							<p style="color:#444444;margin:auto;">{{$network->title}}</p>
							<?php if(Auth::user()){?>
							<a onclick="subscibeToNetwork('{{$network->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$network->id}}_sub">
	                            <div class="text-user-not-subscribed">Bliv medlem</div>
	                            <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                            <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>
	                        </a>

	                        <a href="javascript:;" style="display:none" class="tp-right-link" onclick="makeUnscribe('{{$network->id}}');" id="network_{{$network->id}}_unsub">
	                            <div class="text-user-subscribed">Medlem</div>
	                            <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                            <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
	                        </a>
	                        <?php } ?>
						</div>
						<div class="single-network-cat-des-full">
							<p>
								<?php echo html_entity_decode($network->details); ?>
								<!-- <a href="{{url('network/'.$network->title)}}" style="float:right">Læs mere</a> -->
							</p>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
    @include('postjs')
    <script type="text/javascript">
    	$(document).ready(function(){
    		//$('body').addClass('bg-white');
    	});
    </script>
@endsection