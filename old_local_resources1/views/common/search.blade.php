@extends('layouts.default.app')
@section('content')
<!-- Header area -->
<!-- Header area End-->
<?php  $keyword = urlencode($keyword);?>
<div class="search-content-block bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="{{url('search')}}" method="get">
					<label>Søg igen:</label>
					<input type="text" name="keyword" value="<?php echo !empty($keyword) ? urldecode($keyword):''; ?>" class="search-field">
					<input type="submit" value="Søg" class="btn btn-primary">
				</form>
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
							<div class="box-title">
								Posts der matcher din søgning
							</div>
							<?php 
							$firstFlag = false;
							if(!empty($postData['Post'])){ ?>
								<div id="search_posts_div">
									<?php foreach($postData['Post'] as $post){ 
										$firstFlag = true;
										$postData1 = !empty($postData[$post->id]) ? $postData[$post->id]:array();
										?>
										@include('postview',['post'=>$post,'postData'=>$postData1])
									<?php } ?>
								</div>
								<?php if($firstFlag){ ?>
									<input type="hidden" value="1" id="search_post_input">
									<div class="load_more" id="search_post_div">
										<a class="nextPage" href="{{url('network/loadPages')}}/?keyword=<?php echo !empty($keyword) ? $keyword:''; ?>&page=2&option=search&file=search&tags={{$tags}}"><?php echo cmskey('load_more',true) ?></a>
			                            <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="search_post_img">
			                        </div>
		                        <?php } ?>
							<?php } ?>
							<div class="clearfix"></div>						
						</div>
						<!-- user posts end -->


						<!-- user posts starts -->
						<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 removeMobPadding">
							<div class="box-title">
								Kommentarer der matcher din søgning:
							</div>
							<?php 
							$seFlag = false;
							if(!empty($commentData['Post'])){ ?>
								<!-- ads posts starts -->
								<div id="other_posts_div">
									<?php foreach($commentData['Post'] as $post){
										$seFlag = true; 
										$postData1 = !empty($commentData[$post->id]) ? $commentData[$post->id]:array();
										?>
										@include('postview',['post'=>$post,'postData'=>$postData1])
									<?php } ?>
								</div>
								<?php if($seFlag){ ?>
									<input type="hidden" value="1" id="other_post_input">
									<div class="load_more" id="other_load_more">
										<a class="nextPage" href="{{url('network/loadPages')}}/?keyword=<?php echo !empty($keyword) ? $keyword:''; ?>&page=2&option=other&file=search"><?php echo cmskey('load_more',true) ?></a>
			                            <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="other_post_img">
			                        </div>
		                        <?php } ?>
							<?php } ?>
							<div class="clearfix"></div>

						</div>
						<!-- user posts end -->
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 content-rgt removeMobPadding">
					<div class="box-title">
						Find flere informationer her
					</div>
					<div class="business">
						<?php  
							if(!empty($businessAdSeach['post'])){
							$post = $businessAdSeach['post'];
		                    $postData = !empty($businessAdSeach) ? $businessAdSeach:array(); ?>
							@include('adview',['post'=>$post,'postData'=>$postData])
						<?php } ?>

					</div>
					<div id="network_div">
	                    <?php  foreach($lastCol as $networkData){ 
	                        if($networkData['type'] == 'network'){
	                            $network = $networkData['data'];
	                        ?>
	                        <div class="single-network-cat-full">
	                            <?php  if(!empty($network->image_path)){ ?>
	                            <a href="{{url('network/'.$network->url)}}">
	                                <img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img">
	                            </a>
	                            <?php }else{ ?>
	                                <img src="{{asset('images/img-FACILITETER.jpg')}}" alt="img">
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
	                        $post = $networkData['data'];
	                        $postData = !empty($networkData['PostExtraData']) ? $networkData['PostExtraData']:array();
	                         ?>
	                        @include('adview',['post'=>$post,'postData'=>$postData])
	                    <?php }
	                    } ?>
	                </div>
	                <input type="hidden" value="1" id="network_input">
	                <div class="load_more" id="network_load_more" title="keyword=<?php echo !empty($keyword) ? $keyword:''; ?>&option=network&page=2&file=search">
	                    <a class="nextPage" href="{{url('network/loadPages')}}/?keyword=<?php echo !empty($keyword) ? $keyword:''; ?>&option=network&page=2&file=search"><?php echo cmskey('load_more',true) ?></a>
	                    <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="network_img">                                 
	                </div>
	                <div class="clearfix"></div>	
				</div>
			<?php }else{ ?>
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
                    <div class="business">
						<?php  
						if(!empty($businessAdSeach['post'])){
							$post = $businessAdSeach['post'];
	                    	$postData = !empty($businessAdSeach) ? $businessAdSeach:array(); ?>
							@include('adview',['post'=>$post,'postData'=>$postData])
						<?php } ?>
					</div>					
                    <input type="hidden" value="1" id="mobile_input">
                    <div class="load_more" id="network_load_more">
                        <a class="nextPage" href="{{url('network/loadPages')}}/?keyword=<?php echo !empty($keyword) ? $keyword:''; ?>&page=2&file=search"><?php echo cmskey('load_more',true) ?></a>
                        <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="mobile_img">                                 
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- popups -->
<div class="modal fade ivn-popups in" id="editPostPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
        <div class="vm-layout modal-content style-black ">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{url('images/icons/img-modal-close.png')}}" alt="close">
            </button>            
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="no-border-radius no-shadow no-border no-padding-top ">
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
	//$('body').addClass('bg-white');
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
	$('#search_post_div').jscroll({
	       loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
	       padding: 2000,
	       nextSelector: 'a:last',
           autoTrigger:false
	    }
	);

	$('#other_load_more').jscroll({
	       loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
	       padding: 200,
	       nextSelector: 'a:last',
           autoTrigger:false
	    }
	);
	
	$('#network_load_more').jscroll({
	       loadingHtml: '<img src="'+path+'"  alt="Loading"/>Loading...',
	       padding: 200,
	       nextSelector: 'a:last',
           autoTrigger:false
	    }
	); 
 });
function loadmobile(mobile_input,network_load_more,mobile_img,divID){
    var page = $('#'+mobile_input).val() *1 + 1;
    $('#'+mobile_img).show();
    $.ajax({
        url: "{{url('home/loadPages')}}",
        type: "post",
        data: {page:page,file:'home'},
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
	var Keyword = '{{!empty($keyword) ? $keyword:''}}';
	$('#'+imgID).show();
	$.ajax({
        url: "{{url('network/loadPages')}}",
        type: "post",
        data: {keyword:Keyword,option:option,page:page,file:'search'},
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