<div class="single-ivn-post">
	<div class="tp-ivn">
		<div class="post-cat-name">
			<?php if(!empty($postData['networks'][0])){
					foreach($postData['networks'] as $network){
				?>
			<a href="{{url('category/'.$network->category->title)}}"><?php echo $network->category->title;?></a>//
			<a href="{{url('network/'.$network->title)}}">{{$network->title}}</a><br />

			<?php 	}
				} ?>
		</div>			
	</div> <!-- tp-ivn end -->

	<div class="ad-rating">
		<div class="pull-left"><h3>{{$post->title}}</h3></div>
		<div class="pull-right">{{postTime($post->created_at)}}</div>
		<div class="clearboth"></div>
	</div>
	<?php if(!empty($post->image_path)){?>
	<div class="post-image">
		<?php if(!empty(Auth::user())){?>
		<a href="{{url('showbusiness',$post->user_id)}}">
		<?php }else{?>
		<a href="#">
		<?php } ?>
			<img src="{{asset('uploads/Ad/thumb_'.$post->image_path)}}"  class="img-responsive" alt="Ad image">
		</a>
	</div> <!-- post-image end -->
	<?php } ?>
	

	<?php  $string = substr(strip_tags(html_entity_decode($post->details),'<br><b>'),0); ?>
	<?php if(strlen($string) > 200){ ?>
	<div class="post-desc post_les_{{$post->id}}">
		<?php echo shortString($post->details,200); ?>
	</div>
	<div class="view-details post_les_{{$post->id}}"><a onclick="$('.post_les_{{$post->id}}').toggle()" href="javascript:;">Læs mere</a></div>
	<?php }else{?>
		<div class="post-desc post_les_{{$post->id}}">
			<?php echo fixbrokenHtml(html_entity_decode($post->details)); ?>
		</div>
	<?php } ?>
	<div class="post-desc post_les_{{$post->id}}" style="display:none">
		<?php echo fixbrokenHtml(html_entity_decode($post->details)); ?>
	</div>
	<!-- <div class="view-details post_les_{{$post->id}}" style="display:none"><a onclick="$('.post_les_{{$post->id}}').toggle()" href="javascript:;"><?php echo cmskey('show_les');?></a></div> -->

	<div class="ivn-bottom" style="border-bottom:0px;">
		<div class="ivn-pst-usr-profile admin-profile">
			<div class="inner">
				<?php if(!empty($postData['createdBY'])){?>
				<div class="usr-img">
					<a href="{{url('showbusiness',$post->user_id)}}">
					<img src="{{ asset('uploads/user/'.$postData['createdBY'][0]->profile_image) }}" alt="{{ $postData['createdBY'][0]->first_name}}">
					</a>
				</div>
				<div class="usr-dt">
					<a href="{{url('showbusiness',$post->user_id)}}">
						<div class="name">{{ $postData['createdBY'][0]->first_name}}</div>
					</a>
					<!-- <div class="desc">{{ !empty($postData['company']->companies->name) ? $postData['company']->companies->name:'Iværksætter Netværk'}}</div> -->
				</div>
				<?php }else{
					
				 } ?>
			</div>
		</div>
	</div>
</div>