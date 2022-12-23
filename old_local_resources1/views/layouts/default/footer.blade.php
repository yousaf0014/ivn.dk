<?php if(!empty(Auth::user()) && ($title == 'home' || $title == 'search' || $selectedManu == 'category' || $selectedManu == 'network')){?>
<?php $networks = getNetworks();?>
<div class="clearfix"></div>


<div class="create-post-fixed-outer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="create-post-elmnts">
					<div class="btn-create-post bntFixedCreatePost">
						<span class="txt">Opret post</span>
						<div class="angle-img">
							<img src="{{ asset('images/shape/shape1.png') }}" alt="" class="normal">
							<img src="{{ asset('images/shape/shape1-flip.png') }}" alt="" class="active">
						</div>
					</div>						
					<div class="create-post-body">
						<!-- <div class="post-intro-text" style="background-image:url({{ asset('images/img-post-intro.jpg') }});">
							<div class="post-intro-overlay">
								<div class="post-title">{{cmskey('create_post_header')}}</div>
								<div class="post-desc">
									{{cmskey('create_post_details')}}
								</div>
							</div>
						</div> -->
						<div class="create-post-form-elmnts">
							<form action="{{url('user/Post/')}}" method="post" enctype="multipart/form-data" id="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}" />
								<h3>Opret post</h3>

								<div class="full-box" >
									<label>Vælg Netværk:</label>
									<select name="network_id[]" data-placeholder="Vælg netværk..." class="chosen-select form-control input-sm" multiple tabindex="4">
							            <option value=""></option>
							            <?php foreach($networks as $catid=>$val){?>
							            	<optgroup label="<?php echo  $val['title']; ?>">
							            		<?php foreach($val['network'] as $key => $value) {?>
							            			<option value="<?php echo $key?>"><?php echo $value;?></option>	
							            		<?php } ?>
							                </optgroup>	
							            <?php } ?>
							        </select>
								</div>
								<div class="full-box">
									<label class="full">Tekst</label>
									<textarea name="details"  cols="5"></textarea>
								</div>
								<div class="full-box">
									<label>Tags:</label>
									<select multiple type="text" data-role="tagsinput" name="tags[]" id="tags">
									</select>
								</div>


								<div class="full-box">
									<label class="full">
										Billeder:
									</label>
									<div class="fileChooser">
										<input type="file" class="file" name="image_path" id="fileChooser">
										<img src="{{ asset('images/icons/img-plus-white.png') }}" alt="plus icon" class="imgPlus">
										<img src="" style="display:none;" class="choosedImage">
										
									</div>
									<label class="full">
										<a href="javascript:void(0);" class="imgChoosedRemover" style="display:none;">Remove</a>
									</label>
									
								</div>
								<div class="full-box">
									<div class="text-center">
										<input type="button" onclick="submitPost()" value="Opret post" class="btnSubmitCreatePost btn-primary">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<script type="text/javascript">
	$(function () {
		$("form#post #fileChooser").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = isImageLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
		
		$(".imgChoosedRemover").click(function () {
			$('form#post .choosedImage').attr('src', "");
			$('form#post .imgPlus').show();
			$('form#post .choosedImage').hide();
			$(this).hide();
		});
	});

	function isImageLoaded(e) {
		$('form#post .choosedImage').attr('src', e.target.result);
		$('form#post .choosedImage').show();
		$('form#post .imgPlus').hide();
		$('form#editPost .imgChoosedRemover').show();
	};

//Profile Pic JS
        function handlePostSelect(evt) {
			$('#fileChooser img').attr('src',$('#post_img_ex').val());			
		  }
		 if($('#post_img_ex').length > 0){
			//document.getElementById('post_img_ex').addEventListener('change', handlePostSelect, false);
		}
</script>
<?php  } ?>