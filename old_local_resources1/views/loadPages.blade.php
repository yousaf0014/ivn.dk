<?php
$flag = false;
if(empty($postData)){

}else if($type == 'post'){
	?>
	<?php foreach($postData['Post'] as $post){
		$flag = true;
		$postData1 = !empty($postData[$post->id]) ? $postData[$post->id]:array();
		?>
		@include('postview',['post'=>$post,'postData'=>$postData1])
	<?php } ?>
<?php }else if(!empty($controller) && $controller == 'home'){
		foreach($postData as $postD){
			$flag = true;
			$post = $postD['data'];
			$postData1 = !empty($postD['PostExtraData']) ? $postD['PostExtraData']:array();
			if($postD['type'] == 'ad'){ ?>
				@include('adview',['post'=>$post,'postData'=>$postData1])
	<?php 	}else{ ?>

			<div class="single-network-cat-full">
				<img src="{{asset('uploads/network/thumb_'.$post->image_path)}}" alt="img">
				<p>{{$post->title}}</p>
				<?php if(Auth::user()){ ?>
					<a onclick="subscibeToNetwork('{{$post->id}}')" href="javascript:;" class="tp-right-link">Bliv medlem</a>
					<a onclick="unsubscibeToNetwork('{{$post->id}}')" href="javascript:;" class="tp-right-link">Bliv medlem</a>


					<a onclick="subscibeToNetwork('{{$post->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$post->id}}_sub">
	                    <div class="text-user-not-subscribed">Bliv medlem</div>
	                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                    <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>
	                </a>

	                <a href="javascript:;" style="display:none" class="tp-right-link" onclick="makeUnscribe('{{$post->id}}');" id="network_{{$post->id}}_unsub">
	                    <div class="text-user-subscribed">Medlem</div>
	                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                    <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
	                </a>
				<?php } ?>
			</div>			
			<?php }
		}
}else if($type == 'network'){ 
	foreach($postData as $postD){
			$flag = true;
			$post = $postD['data'];
			$postData1 = !empty($postD['PostExtraData']) ? $postD['PostExtraData']:array();
			if($postD['type'] == 'ad'){ ?>
				@include('adview',['post'=>$post,'postData'=>$postData1])
	<?php 	}else{ ?>

			<div class="single-network-cat-full">
				<img src="{{asset('uploads/network/thumb_'.$post->image_path)}}" alt="img">
				<p><a href="{{url('network/'.$post->url)}}">{{$post->title}}</a></p>
				<?php if(Auth::user()){ ?>
					<a onclick="subscibeToNetwork('{{$post->id}}')" href="javascript:;" class="tp-right-link">Bliv medlem</a>
					<a onclick="unsubscibeToNetwork('{{$post->id}}')" href="javascript:;" class="tp-right-link">Bliv medlem</a>


					<a onclick="subscibeToNetwork('{{$post->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$post->id}}_sub">
	                    <div class="text-user-not-subscribed">Bliv medlem</div>
	                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                    <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>
	                </a>

	                <a href="javascript:;" style="display:none" class="tp-right-link" onclick="makeUnscribe('{{$post->id}}');" id="network_{{$post->id}}_unsub">
	                    <div class="text-user-subscribed">Medlem</div>
	                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
	                    <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
	                </a>
				<?php } ?>
			</div>			
			<?php }
		}
	} ?>
<?php if($flag){ ?>
	<a class="nextPage" href="<?php echo $url; ?>"><?php echo cmskey('load_more',true) ?></a>
<?php } ?>