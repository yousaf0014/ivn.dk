@extends('layouts.default.app')
<!-- if there are creation errors, they will show here -->
@section('content')
<div class="posts-by-mob" style="display:none;"><a href="#">Brians posts</a></div>
	<div class="content-area">
		<div class="container">
			<div class="row">
				<?php  if(!$mobile){?>
					<div class="col-sm-8 col-md-8 col-lg-8 content-lft">
						<div class="row">
							<!-- user posts starts -->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 removeMobPadding">							
								<div id="user_posts_div">
		                            <?php foreach($feed1['Post'] as $post){ 
		                                $postData = !empty($feed1[$post->id]) ? $feed1[$post->id]:array();
		                                ?>
		                                @include('postview',['post'=>$post,'postData'=>$postData])
		                            <?php } ?>
		                        </div>
	                            <input type="hidden" value="1" id="user_post_input">
	                            <div class="nextPage" class="load_more" id="user_post_div">
	                            	<a href="{{url('user/loadprofilePages')}}/?option=user&page=2&file=home&user={{$user->id}}"><?php echo cmskey('load_more',true) ?></a>
	                                <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="user_post_img">
	                            </div>                        
		                        <div class="clearfix"></div>
							</div>
							<!-- user posts end -->

							<!-- user posts starts -->
							<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 removeMobPadding">
								<div id="other_posts_div">
		                            <?php foreach($feed2['Post'] as $post){ 
		                                $postData = !empty($feed2[$post->id]) ? $feed2[$post->id]:array();
		                                ?>
		                                @include('postview',['post'=>$post,'postData'=>$postData])
		                            <?php } ?>
		                        </div>
		                        <input type="hidden" value="1" id="other_post_input">
		                        <div class="load_more" id="other_load_more">
		                            <a class="nextPage" href="{{url('user/loadprofilePages')}}/?option=user_comments&page=2&file=home&user={{$user->id}}"><?php echo cmskey('load_more',true) ?></a>
		                            <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="other_post_img">                                  
		                        </div>                        
		                        <div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 content-rgt removeMobPadding">
						<div id="network_div">
	                        <?php  foreach($feed3 as $network){  ?>
	                            <div class="single-network-cat-full network_{{$network->id}}">
	                                <img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img">
	                                <p>{{$network->title}}</p>
	                                <?php if(Auth::user()->id != $user->id ){?>
	                                    <a style="display:none" onclick="subscibeToNetwork('{{$network->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$network->id}}_sub">
	                                        <div class="text-user-not-subscribed">Bliv medlem</div>
	                                        <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                                        <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>

	                                    </a>

	                                    <a href="javascript:;" class="tp-right-link" onclick="makeUnscribe('{{$network->id}}');" id="network_{{$network->id}}_unsub">
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
	                            </div>                         -->
	                        <?php 
	                    } ?>
	                	</div>
		                <input type="hidden" value="1" id="network_input">
		                <div class="load_more" id="network_load_more">
		                    <a class="nextPage" href="{{url('user/loadprofilePages')}}/?option=network&page=2&file=home&user={{$user->id}}"><?php echo cmskey('load_more',true) ?></a>
		                    <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="network_img">                                 
		                </div>
		                <div class="clearfix"></div>
					</div>
				<?php }else{ ?>
					<div class="col-sm-4 col-md-4 col-lg-4 content-rgt removeMobPadding">
						<div id="mobile_div">
                            <?php  
                            foreach($mobileData as $data){ 
                                if($data['type'] == 'network'){
                                    $network = $data['data'];                                    
                                ?>
                                <div class="single-network-cat-full network_{{$network->id}}">
                                    <img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img">
                                    <p>{{$network->title}}</p>
                                    <?php if(Auth::user()->id != $user->id){?>
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
                                $postData = $data['PostExtraData'];
                                $post = $data['data']; ?>
                                @include('postview',['post'=>$post,'postData'=>$postData])
                            <?php }
	                            } ?>
	                    </div>
	                    <input type="hidden" value="1" id="mobile_input">
	                    <div class="load_more" id="network_load_more">
	                        <a class="nextPage" href="{{url('user/loadprofilePages')}}/?page=2&file=home&user={{$user->id}}"><?php echo cmskey('load_more',true) ?></a>
	                        <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="mobile_img">                                 
	                    </div>
	                    <div class="clearfix"></div>
					</div>
				<?php } ?>
			</div>
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
        if($(this).attr('href') == '#' || $(this).attr('href') == 'javascript:;'){
            $(this).remove();
        }
    });
});

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
function loadmobile(mobile_input,network_load_more,mobile_img,divID){
    var page = $('#'+mobile_input).val() *1 + 1;
    $('#'+mobile_img).show();
    $.ajax({
        url: "{{url('user/loadprofilePages')}}",
        type: "post",
        data: {page:page,user:{{$user->id}},file:'userProfile'},
        success: function(res){
            if(res == ''){
                $('#'+network_load_more).html('No more data to show');
                setTimeout(hideLoadmoreMessage(network_load_more),1000);
            }else if(res != 'false'){
                $('#'+divID).append(res);
                $('#'+mobile_input).val(page);
                $('#'+mobile_img).hide();
            }else{
                $('#'+network_load_more).hide();
            }
        }
    });
}
function loadmore(option,inputpage,imgID,divID,loadmorelink){
    var page = $('#'+inputpage).val() *1 + 1;
    $('#'+imgID).show();
    $.ajax({
        url: "{{url('user/loadprofilePages')}}",
        type: "post",
        data: {option:option,page:page,user:{{$user->id}},file:'home'},
        success: function(res){
            if(res == ''){
                $('#'+loadmorelink).html('No more data to show');
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