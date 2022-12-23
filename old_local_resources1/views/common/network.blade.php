@extends('layouts.default.app')
@section('content')
<!-- category landing page start -->
	<div class="network-landing-top" style="background-image:url({{asset('uploads/network/'.$networkData->image_path)}})">
		<div class="blue-bg overlay" style="">
			<div class="container full-height">
				<div class="row full-height">
					<div class="col-md-12 full-height">
						<?php if(Auth::user()){?>
							<div class="network-tag">
								<?php if(empty($userNetwork)){ ?>
		                            <a onclick="subscibeToNetwork('{{$networkData->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$networkData->id}}_sub">
		                                <div class="text-user-not-subscribed">Bliv medlem</div>
		                                <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
		                                <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>
		                            </a>

		                            <a href="javascript:;" style="display:none" class="tp-right-link" onclick="makeUnscribe('{{$networkData->id}}');" id="network_{{$networkData->id}}_unsub">
		                                <div class="text-user-subscribed">Medlem</div>
		                                <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
		                                <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
		                            </a>
	                            <?php }else{ ?>
	                            	<a style="display:none" onclick="subscibeToNetwork('{{$networkData->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$networkData->id}}_sub">
		                                <div class="text-user-not-subscribed">Bliv medlem</div>
		                                <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
		                                <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>
		                            </a>

		                            <a href="javascript:;"  class="tp-right-link" onclick="makeUnscribe('{{$networkData->id}}');" id="network_{{$networkData->id}}_unsub">
		                                <div class="text-user-subscribed">Medlem</div>
		                                <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
		                                <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
		                            </a>
	                            <?php }?>
	                    	</div>
	                    <?php } ?>
						<h1 class="cat-title"><?php echo $networkData->title ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="network-landing-desc">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>
						<?php echo html_entity_decode($networkData->details); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="content-area">
		<div class="container">
			<div class="row">
				<?php if(!$mobile){ ?>	
						
					<div class="col-sm-8 col-md-8 col-lg-8 content-lft">
						<div class="row">
							<!-- user posts starts -->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 removeMobPadding">
								<div id="user_posts_div">
									<?php foreach($networkPosts['Post'] as $post){ 
										$postData = !empty($networkPosts[$post->id]) ? $networkPosts[$post->id]:array();
										?>
										@include('postview',['post'=>$post,'postData'=>$postData])
									<?php } ?>
								</div>
								<input type="hidden" value="1" id="user_post_input">
								<div class="load_more" id="user_post_div">
									<a class="nextPage" href="{{url('network/loadPages')}}/?option=user&page=2&file=network&row=<?php echo $networkData->id ?>"><?php echo cmskey('load_more',true) ?></a>
									<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="user_post_img">
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- user posts end -->
							<?php if($ismobile == false){ ?>
								<!-- user posts starts -->
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 removeMobPadding">
									<div id="other_posts_div">
									<?php foreach($otherPosts['Post'] as $post){ 
										$postData = !empty($otherPosts[$post->id]) ? $otherPosts[$post->id]:array();
										?>
										@include('postview',['post'=>$post,'postData'=>$postData])
										<?php } ?>
									</div>
									<input type="hidden" value="1" id="other_post_input">
									<div class="load_more" id="other_load_more">
										<a class="nextPage" href="{{url('network/loadPages')}}/?option=other&page=2&file=network&row=<?php echo $networkData->id ?>"><?php echo cmskey('load_more',true) ?></a>									
										<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="other_post_img">									
									</div>
									<div class="clearfix"></div>
								</div>
								<!-- user posts end -->
							<?php } ?>
						</div>
					</div>
					<?php if($ismobile === false){ ?>
					<div class="col-sm-4 col-md-4 col-lg-4 content-rgt removeMobPadding">
						<div id="network_div">
							<?php  foreach($lastCol as $networkData1){ 
	                        if($networkData1['type'] == 'network'){
	                            $network = $networkData1['data'];
	                        ?>
		                        <div class="single-network-cat-full">
		                            <?php  if(!empty($network->image_path)){ ?>
		                            <a href="{{url('network/'.$network->url)}}"><img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img"></a>
		                            <?php }else{ ?>
		                            <a href="{{url('network/'.$network->url)}}"><img src="{{asset('images/img-FACILITETER.jpg')}}" alt="img"></a>
		                            <?php } ?>
		                            <p><a href="{{url('network/'.$network->url)}}">{{$network->title}}</a></p>
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
		                        <!-- <div class="single-network-cat-des-full network_{{$network->id}}">
		                            <p>
		                                {{shortString($network->details,200)}}
		                            </p>
		                        </div> -->
		                    <?php }else{
		                        $post = $networkData1['data'];
		                        $postData = !empty($networkData1['PostExtraData']) ? $networkData1['PostExtraData']:array();
		                         ?>
		                        @include('adview',['post'=>$post,'postData'=>$postData])
		                    <?php }
		                    } ?>
						</div>
						<input type="hidden" value="1" id="network_input">
						<div class="load_more" id="network_load_more">
							<a class="nextPage" href="{{url('network/loadPages')}}/?option=network&page=2&file=network&row=<?php echo $networkData->id ?>"><?php echo cmskey('load_more',true) ?></a>
							<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="network_img">									
						</div>
						<div class="clearfix"></div>	
					</div>
					<?php } ?>
				<?php }else{?>

					<div class="col-sm-4 col-md-4 col-lg-4 content-rgt removeMobPadding">
	                    <div id="mobile_div">
	                            <?php  foreach($mobileData as $data){ 
	                                if($data['type'] == 'network'){
	                                    $network = $data['data'];
	                                ?>
	                                <div class="single-network-cat-full network_{{$network->id}}">
	                                    <a href="{{url('network/'.$network->url)}}">
	                                        <img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img">
	                                    </a>
	                                    <p><a href="{{url('network/'.$network->url)}}">{{$network->title}}</a></p>
	                                    <?php if(Auth::user()){?>
	                                        <a onclick="subscibeToNetwork('{{$network->id}}')" href="javascript:;" class="tp-right-link"> Bliv medlem</a>
	                                    <?php } ?>
	                                </div>
	                                <!--<div class="single-network-cat-des-full network_{{$network->id}}">
	                                    <p>
	                                        {{shortString($network->details,200)}}
	                                    </p>
	                                </div> -->
	                            <?php }else if($data['type'] == 'ad'){
	                                $postData = $data['PostExtraData'];
	                                $post = $data['data']; ?>
	                                @include('adview',['post'=>$post,'postData'=>$postData])
	                            <?php }else{ 
	                                $postData = $data['PostExtraData'];
	                                $post = $data['data']; ?>
	                                @include('postview',['post'=>$post,'postData'=>$postData])
	                            <?php }
	                            } ?>
	                    </div>
	                    <input type="hidden" value="1" id="mobile_input">
	                    <div class="load_more" id="network_load_more">
	                        <a class="nextPage" href="{{url('network/loadPages')}}/?page=2&file=network&row=<?php echo $networkData->id ?>"><?php echo cmskey('load_more',true) ?></a>
	                        <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="mobile_img">                                 
	                    </div>
	                    <div class="clearfix"></div>
	                </div>

				<?php } ?>
			</div>
		</div>
	</div>

	<!-- Modal -->
<!-- popups -->
<div class="modal fade ivn-popups in" id="editPostPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
        <div class="vm-layout modal-content style-black ">
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="no-border-radius no-shadow no-border no-padding-top ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{url('images/white_close.png')}}" alt="close">
                        </button>
                        <div class="modal-body">
                       
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	
@endsection
@section('scripts')
@include('postjs')
 <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
 <script type="text/javascript" src="{{asset('js/jquery.form.js?v=1')}}"></script>
 <script type="text/javascript" src="{{asset('js/jquery.jscroll.js?v=1')}}"></script> 
 <script>
 function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

$(window).scroll(function(){
    $('.nextPage').each(function(  ) {
        if(isScrolledIntoView(this)){
            $(this).trigger('click');
            $(this).removeClass('nextPage');
            $(this).attr('href','#');
        }
        //setTimeout("$("+this+").remove();" ,2000);
        if($(this).attr('href') == '#' || $(this).attr('href') == 'javascript:;'){
        	$(this).remove();
        }
    });
});

function removeLink(elem){
	$(elem).remove();
}
$(document).ready(function(){
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('#crf_token').val() }
    });
    $("#editPostPopup").on("show.bs.modal", function(e) {
        url =  $(e.relatedTarget).data('target-url');
        $.get( url , function( data ) {
            $(".modal-body").html(data);
        });
    });
    var path = "{{ asset('img/loading.gif') }}";
   $('#user_post_div').jscroll({
           loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
           padding: 0,
           callback: rebindLoading,
           nextSelector: 'a:last',
           autoTrigger:false
        }
   );
   $('#other_load_more').jscroll({
           loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
           padding: 0,
           callback: rebindLoading,
           nextSelector: 'a:last',
           autoTrigger:false
        }
   );
   $('#network_load_more').jscroll({
           loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
           padding: 0,
           callback: rebindLoading,
           nextSelector: 'a:last',
           autoTrigger:false
        }
   );
 });
 function rebindLoading(response){
 	$(this).hide().fadeIn(2000);
}

 function loadmore(option,inputpage,imgID,divID,loadmorelink){
 		var page = $('#'+inputpage).val() *1 + 1;
 		$('#'+imgID).show();
 		$.ajax({
            url: "{{url('network/loadPages')}}",
            type: "post",
            data: {option:option,page:page,file:'network',row:<?php echo $networkData->id ?>},
            success: function(res){
            	if(res == ''){
            		$('#'+loadmorelink).html('No more data to show');
            		$('#'+imgID).hide();
            		setTimeout(hideLoadmoreMessage(loadmorelink),1000);
            	}else if(res != 'false'){
	            	$('#'+divID).append(res);
	                $('#'+inputpage).val(page);
	                $('#'+imgID).hide();
                }else{
                	$('#'+loadmorelink).hide();
                }
            }
        });
 	}
 </script>
@endsection