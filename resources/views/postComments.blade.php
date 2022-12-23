<?php if(!empty($comments['postComments'])){
		foreach($comments['postComments'] as $comment){			
 ?>
			<div class="single-post-comment">
				<div class="tp-post">
					<div class="comment-by">
						<div class="commntr-img">
							<?php if($comment->profile_image){ ?>
			                	<img src="{{ asset('uploads/profile/'.$comment->profile_image) }}" alt="{{$comment->first_name.' '.$comment->last_name}}">
			            	<?php } ?>
						</div>
						<div class="commntr-dt">
							<div class="name">{{$comment->first_name.' '.$comment->last_name}}</div>
						</div>
					</div>
					

					<div class="report-post">
						<div class="btnRportPost">
							<img src="{{asset('images/icons/ivn-report-post-btn.png')}}">
						 </div>
						<div class="links-report-post">
							<a href="javascript:;" onclick="reportComment('<?php echo $comment->comment_id; ?>')">Report Comment</a>
							<a href="{{url('user/editcomment/'.$comment->comment_id.'/edit')}}" title="Edit Comment" class="edit comment">Edit Comment</a>
			            	<a href="{{url('user/delete',$comment->comment_id)}}" title="Delete Comment">
			                	Delete Comment
			                </a>
						</div>
					</div>		
					<div class="comment-date" style="padding-right:5px;">{{postTime($comment->c_created_at)}}</div>
				</div>
				
				<div class="comment-msg comment_{{$comment->comment_id}}">
					{{shortStringComment($comment->comment,200)}}
					
					@if(stringLength($comment->comment) > 200)
						...<a href="javascript:;" onclick="$('.comment_{{$comment->comment_id}}').toggle();" class="view-details">Læs mere</a>
					@endif
				</div>
				<div class="comment-msg comment_{{$comment->comment_id}}" style="display:none">
					<?php echo html_entity_decode($comment->comment); ?>
					@if(stringLength($comment->comment) > 200)
						<!-- <a href="javascript:;" onclick="$('.comment_{{$comment->comment_id}}').toggle();" class="view-details"><?php echo  cmskey('show_les');?></a> -->
					@endif
				</div>
				<?php if(!empty($comment->image_path)){ ?>
					<div class="imageBox clearfix text-center" style="padding-bottom:15px;">
						<img src="{{asset('uploads/Comment/'.$comment->image_path)}}" class="img-responsive" alt="">
					</div>
				<?php } ?>

				<div class="comment-rating">
					<?php if(Auth::user()){ ?>
						<button class="btn-ivn-post-rating-mns" onclick="rateComment('minus',{{$comment->cid}})"><img src="{{asset('images/icons/ic-post-vote-mins.png')}}" alt="post mins" ></button>
						<div class="totle-votes" id="comment_count_{{$comment->cid}}">{{empty($comments['postCommentRatings'][$comment->cid]) ? 0:$comments['postCommentRatings'][$comment->cid]}}</div>
						<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="comment_img_{{$comment->cid}}">
						<button class="btn-ivn-post-rating-plus" onclick="rateComment('plus',{{$comment->cid}})"><img src="{{asset('images/icons/ic-post-vote-plus.png')}}" alt="post plus"></button>
					<?php  }else{?>
							<div class="totle-votes" id="comment_count_{{$comment->cid}}">{{empty($comments['postCommentRatings'][$comment->cid]) ? 0:$comments['postCommentRatings'][$comment->cid]}}</div>
					<?php } ?>
				</div> <!-- post-rating end -->
			</div> <!-- single-post-comment end -->
<?php 	}
	}
?>