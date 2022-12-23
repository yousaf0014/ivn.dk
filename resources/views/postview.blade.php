<div class="single-ivn-post">
	<div class="tp-ivn">
		<div class="post-cat-name">
			<?php if(!empty($postData['networks'][0])){
					foreach($postData['networks'] as $network){
				?>
			<a href="{{url('category/'.$network->category->url)}}"><?php echo $network->category->title;?></a> //
			<a href="{{url('network/'.$network->url)}}">{{$network->title}}</a><br />

			<?php 	break;
					}
				} ?>
		</div>
		<div class="report-post">
			<?php if(!empty(Auth::user())){ ?>
				<div class="btnRportPost">
					<img src="{{asset('images/icons/ivn-report-post-btn.png')}}">
				</div>				
				<div class="links-report-post">				
					<a href="javascript:;" onclick="reportPost('<?php echo $post->id; ?>')"><?php echo cmskey('report_post',true); ?></a>
				<?php if($post->user_id == Auth::user()->id){ ?>
					<?php if(canEdit($post->user_id,$post->created_at)){ ?>
						<a data-target-url="{{url('user/postEdit/'.$post->id)}}" href="javascript:;" data-toggle="modal" data-target-id="{{$post->id}}" data-target="#editPostPopup" class="edit_info edit Post" title="Edit Post"><?php echo cmskey('edit_post',true); ?></a>
	                <?php } ?>
	                	<a href="{{url('user/deletePost',$post->id)}}" title="Delete Post">
	                    	<?php echo cmskey('delete_post',true); ?>
	                    </a>          
				<?php } ?>
					</div>
			<?php } ?>
		</div>		
	</div> <!-- tp-ivn end -->

	<div class="post-date">
		<div class="pull-left">{{postTime($post->created_at)}}</div>
		<div class="clearboth"></div>
	</div>
	<div class="post-date post-rating">
		<div class="pull-left" style="font-style: normal;"><h3>{{$post->title}}</h3></div>
		<div class="pull-right" style="margin-top: 25px;">
		<?php if(Auth::user()){ ?>
		<button class="btn-ivn-post-rating-mns" onclick="ratePost('minus','{{$post->id}}')"><img src="{{asset('images/icons/ic-post-vote-mins.png')}}" alt="post mins" ></button>
		<div class="totle-votes count" id="post_count_{{$post->id}}">{{empty($postData['postRatings'][0]->post_rate) ? 0:$postData['postRatings'][0]->post_rate}}</div>
		<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="post_img_{{$post->id}}">
		<button class="btn-ivn-post-rating-plus" onclick="ratePost('plus','{{$post->id}}')"><img src="{{asset('images/icons/ic-post-vote-plus.png')}}" alt="post plus"></button>
		<?php } /*else{?>
			<div class="totle-votes count" id="post_count_{{$post->id}}">{{empty($postData['postRatings'][0]->user_ratings) ? 0:$postData['postRatings'][0]->user_ratings}}</div>
		<?php } */?>
		</div>
		<div class="clearboth"></div>
	</div> <!-- post-rating end -->
	<?php if($post->image_path){ ?>
	<div class="post-image">
		<!-- <a href="{{url('/postDetails',$post->id)}}"> -->
			<img src="{{asset('uploads/Post/thumb_'.$post->image_path)}}"  class="img-responsive" alt="post image">
		<!-- </a> -->
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


	<?php if(!isAdminPost($post->user_id)){ ?>
		<div class="ivn-bottom">
			<?php if(!empty($postData['postTags'][0]->text)){ ?>
				<div class="post-tags">
					<img src="{{asset('images/icons/ic-post-tags.png')}}" alt="ic">
					<div class="tags">
						<?php 
									foreach($postData['postTags'] as $tag){
							?>
									<a href="{{url('search')}}?keyword={{$tag->text}}&tags=true">{{$tag->text}}</a>
						<?php 			
							} ?>
					</div>
				</div>
			<?php } ?>
			<div class="ivn-pst-usr-profile">
				<div class="inner">
					<?php if($postData['createdBY'][0]->user_type == 'business'){ ?>
							<div class="usr-dt">
								<div class="name">
									<a href="{{url('showbusiness',$postData['createdBY'][0]->id)}}">
										{{ !empty($postData['createdBY'][0]) ? $postData['createdBY'][0]->first_name.' '.$postData['createdBY'][0]->last_name:'' }}
									</a>
								</div>
								<div class="desc">{{ !empty($postData['company']->companies->name) ? $postData['company']->companies->name:''}} </div>
							</div>
							
							<div class="usr-img">
								<a href="{{url('showbusiness/',$postData['createdBY'][0]->id)}}">
									<img src="{{ asset('uploads/user/' . $postData['createdBY'][0]->profile_image) }}" alt="user image">
								<s/a>	
							</div>
					<?php }else{ ?>
							<div class="usr-dt">
								<div class="name">
									<a href="{{url('viewProfile',$postData['createdBY'][0]->id)}}">
										{{ !empty($postData['createdBY'][0]) ? $postData['createdBY'][0]->first_name.' '.$postData['createdBY'][0]->last_name:'' }}
									</a>
								</div>
								<div class="desc">{{ !empty($postData['company']->companies->name) ? $postData['company']->companies->name:''}} </div>
							</div>
							
							<div class="usr-img">
								<a href="{{url('viewProfile',$postData['createdBY'][0]->id)}}">
									<img src="{{ asset('uploads/profile/'.$postData['createdBY'][0]->profile_image) }}" alt="user image">
								</a>
							</div>
							
					<?php } ?>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<div class="ivn-bottom admin-style">
			<!--<div class="post-tags">
				<img src="{{asset('images/icons/ic-post-tags.png')}}" alt="ic">
				<div class="tags">
					<?php if($postData['postTags']->count() > 0){ 
								foreach($postData['postTags'] as $tag){
						?>
								<a href="#">{{$tag->text}}</a>
					<?php 			}
						} ?>
				</div>
			</div> -->

			<div class="ivn-pst-usr-profile admin-profile">
				<div class="inner">
					<?php if(!empty($postData['createdBY'])){?>
					<div class="usr-img">
						<img src="{{ asset('uploads/profile/'.$postData['createdBY'][0]->profile_image) }}" alt="{{ $postData['createdBY'][0]->first_name}}">
					</div>
					<div class="usr-dt">
							<div class="name">{{ $postData['createdBY'][0]->first_name}}</div>
						
					</div>
					<?php }else{
						
					 } ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="bx-total-comments" id="comment_count_{{$post->id}}">
		<span>{{!empty($postData['comment_count']) ? $postData['comment_count']:0}}</span>
	</div>
	<div class="comment-shower-mobile" style="display:none;">
		<div class="txt">Opret post</div>
		<div class="icon">
			<img src="{{ asset('/images/shape/shape1.png') }}" alt="ic" class="shape">
		</div>
	</div>
	<div class="post-comments" id="post_comments<?php echo $post->id; ?>">
		<?php 
		$commnetCount = 0;
		if(!empty($postData['postComments'])){?>
		<div id="comment_box_<?php echo $post->id; ?>">
		<?php foreach($postData['postComments'] as $commnets){
                if(!empty($commnets->cid)){
                ?>
                	<div class="single-post-comment <?php echo $commnetCount++%2 == 0? 'altrow':''; ?>" id="comment_<?php echo $commnets->comment_id; ?>">
						<div class="tp-post">
							<div class="comment-by">
								<div class="commntr-img">
									<?php if($commnets->profile_image){ ?>
                                    	<a href="{{url('viewProfile',$commnets->c_user_id)}}">
	                                    	<img src="{{ asset('uploads/profile/'.$commnets->profile_image) }}" alt="{{$commnets->first_name.' '.$commnets->last_name}}">
	                                    </a>
                                	<?php } ?>
								</div>
								<div class="commntr-dt">
									<div class="name"><a href="{{url('viewProfile',$commnets->c_user_id)}}">{{$commnets->first_name.' '.$commnets->last_name}}</a></div>
									<div class="desc">{{$commnets->company_name}}</div>
								</div>
							</div>
							
							<div class="report-post">
								<?php if(!empty(Auth::user())){ ?>
									<div class="btnRportPost">
										<img src="{{asset('images/icons/ivn-report-post-btn.png')}}">
									 </div>
									<div class="links-report-post">
										<a href="javascript:;" onclick="reportComment('<?php echo $commnets->comment_id; ?>')"><?php echo cmskey('report_comment',true); ?></a>
										<?php if($commnets->c_user_id == Auth::user()->id){ ?>
											<?php if(canEdit($commnets->c_user_id,$commnets->created_at)){ ?>
												<a data-target-url="{{url('user/comment/'.$post->id.'/'.$commnets->comment_id)}}" href="javascript:;" data-toggle="modal" data-target-id="{{$commnets->comment_id}}" data-target="#editPostPopup" class="edit_info edit Post" title="Edit Post"><?php echo cmskey('edit_comment',true); ?></a>
							                <?php } ?>
						                	<a href="{{url('user/deleteComment',$commnets->comment_id)}}/0" title="Delete Comment">
						                    	<?php echo cmskey('delete_comment',true); ?>
						                    </a>
						               	<?php } ?>
									</div>
								<?php } ?>
							</div>		
							<div class="comment-date" style="padding-right:5px;">{{postTime($commnets->c_created_at)}}</div>
						</div>
						<div class="comment-msg comment_{{$commnets->comment_id}}">
							<?php echo shortStringComment($commnets->comment,200); ?>
							@if(stringLength($commnets->comment) > 200)
								...<a href="javascript:;" onclick="$('.comment_{{$commnets->comment_id}}').toggle();" class="view-details">Læs mere</a>
							@endif
						</div>
						<div class="comment-msg comment_{{$commnets->comment_id}}" style="display:none">
							<?php echo html_entity_decode($commnets->comment); ?>
							@if(stringLength($commnets->comment) > 200)
								<!-- <a href="javascript:;" onclick="$('.comment_{{$commnets->comment_id}}').toggle();" class="view-details"><?php echo  cmskey('show_les');?></a> -->
							@endif
						</div>
						<?php if(!empty($commnets->image_path)){ ?>
							<div class="imageBox clearfix text-center" style="padding-bottom:15px;">
								<img src="{{asset('uploads/Comment/'.$commnets->image_path)}}" class="img-responsive" alt="">
							</div>
						<?php } ?>
						<div class="comment-rating">
							<?php if(Auth::user()){ ?>
							<button class="btn-ivn-post-rating-mns" onclick="rateComment('minus',{{$commnets->cid}})"><img src="{{asset('images/icons/ic-post-vote-mins.png')}}" alt="post mins" ></button>
							<div class="totle-votes" id="comment_count_{{$commnets->cid}}">{{empty($postData['postCommentRatings'][$commnets->cid]) ? 0:$postData['postCommentRatings'][$commnets->cid]}}</div>
							<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="comment_img_{{$commnets->cid}}">
							<button class="btn-ivn-post-rating-plus" onclick="rateComment('plus',{{$commnets->cid}})"><img src="{{asset('images/icons/ic-post-vote-plus.png')}}" alt="post plus"></button>
							<?php  }else{?>
									<div class="totle-votes" id="comment_count_{{$commnets->cid}}">{{empty($postData['postCommentRatings'][$commnets->cid]) ? 0:$postData['postCommentRatings'][$commnets->cid]}}</div>
							<?php } ?>
						</div> <!-- post-rating end -->
					</div> <!-- single-post-comment end -->
		<?php 	}
			}
		 ?>
		</div>
		<?php if(!empty($postData['comment_count']) && $postData['comment_count'] > 2 ){?>		
			<div class="load-more-comments">
				<span>
					<a href="javascript:;" onclick="loadMoreComments(this,'{{$post->id}}')">Se flere kommentarer</a>
					<img src="{{ asset('img/loading.gif')}}" alt="" style="display:none" id="comment_load_{{$post->id}}">
					<input type="hidden" value="1" id="comment_{{$post->id}}_page"> 
				</span>
			</div>
		<?php } ?>

		<?php } ?>
		<?php if(canComment()){?>
		
		<div class="comment-reply" id="comment_form_{{$post->id}}">
			<form class="ajax_form" id="comment_ajax_{{$post->id}}" enctype="multipart/form-data" method="post" action="{{url('/user/comment',$post->id)}}/0">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="post" value="" id="post_iiid">
				<textarea name="comment" cols="5" onkeypress="checkEnter('<?php echo  $post->id; ?>',event,this)" class="comment form-control" placeholder="Kommentér"></textarea>
				<div class="insert-img">
					<input type="file" name="image_path" value="" class="fil" onchange="readURL(this);">
					Indsæt billede
				</div>
				<div class="showSelectedImage" style="display:none;">
					<div class="imgDIv">
						<img src=""/>
					</div>
				</div>

			</form>
		</div>		
		<?php } ?>
	</div>
</div>