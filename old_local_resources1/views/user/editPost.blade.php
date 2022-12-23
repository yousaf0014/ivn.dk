<div class="modal-body padding-bottom-100" style="overflow:hidden;">
    <div class="create-post-elmnts">
        <div class="create-post-body active">
            <div class="create-post-form-elmnts">
                <form action="{{url('user/updatePost/'.$post->id)}}" method="post" enctype="multipart/form-data" id="editPost">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <h3>Opret post</h3>
                    <div class="full-box" style="display:none">
                        <label>Vælg kategori:</label>
                        <select  id="" style="display:none;">
                            <option></option>
                            <option value="">Categories</option>
                        </select>                                   
                    </div>

                    <div class="full-box" >
                        <label>Vælg Netværk:</label>
                        <select id="" style="display:none;">
                            <option></option>
                            <option value="">Networks</option>
                        </select>
                        <select name="network_id[]" data-placeholder="Choose a Networks..." class="chosen-select1 form-control input-sm" multiple tabindex="4">
                            <option value=""></option>
                            <?php foreach($networks as $catid=>$val){?>
                                <optgroup label="<?php echo  $val['title']; ?>">
                                    <?php foreach($val['network'] as $key => $value) {?>
                                        <option value="<?php echo $key?>" <?php echo !empty($selectedNetworks[$key]) ? 'selected="selected"':''; ?> ><?php echo $value;?></option> 
                                    <?php } ?>
                                </optgroup> 
                            <?php } ?>
                        </select>
                    </div>
                    <div class="full-box" style="display:none" >
                        <label>Title:</label>
                        <input name="title" value="{{$post->title}}" style="width:55%">
                    </div>
                    <div class="full-box">
                        <label class="full">Tekst</label>
                        <textarea name="details"  cols="5">{{$post->details}}</textarea>
                    </div>
                    <div class="full-box">
                        <label>Tags:</label>
                        <select multiple type="text" data-role="tagsinput" name="tags[]" id="tag">
                            <?php 
                            if($tags){
                                foreach($tags as $tag){ ?>
                                    <option value="<?php echo $tag; ?>">{{$tag}}</option>
                                <?php } 
                            } ?>
                        </select>
                    </div>

                    <div class="full-box">
                        <label class="full">
                            Billeder:
                        </label>
                        <div class="fileChooser">
                            <input type="file" class="file" name="image_path" id="fileChooser1">
                            <img src="{{ asset('images/icons/img-plus-white.png') }}" alt="plus icon" class="imgPlus">
                            <img src="" style="display:none;" class="choosedImage">
                            
                        </div>
                        <label class="full">
                            <a href="javascript:void(0);" class="imgChoosedRemover1" style="display:none;">Remove</a>
                        </label>
                        

                    </div>

                    <div class="full-box">
                        <div class="text-center">
                            <input type="button" onclick="submitPost1()" value="Opret post" class="btnSubmitCreatePost btn-primary">
                        </div>
                    </div>
                </form>
            </div>                
        </div>
    </div>
</div>
<script type="text/javascript">
    function submitPost1(){
        var ext = $('#fileChooser1').val().split('.').pop().toLowerCase();
        if($('#fileChooser1').val() != ''){
            if(!($.inArray(ext, ['gif','jpg','jpeg','pjpeg','bmp','png']) == -1)){
                $('#editPost').submit();
            }else{
                alert("<?php echo cmskey('not_valid_extention');?>");
            }
        }else{
            $('#editPost').submit();
        }

        return false;
    }

    $(document).ready(function(){
        $('select#tag').tagsinput('items');
        $('.chosen-select1').chosen({width: '55%'} );
        options = {
                rules: {
                    "title": "required",
                    "details": "required",  
                    'network_id[]':"required",                      
                },
                messages: {
                    "title": "Indtast venligst en titel",
                    "details": " Indtast venligst en tekst",  
                    'network_id[]':"Vælg venligst et netværk",                      
                }
            }
            $.validator.setDefaults({ ignore: ":hidden:not(select)" });
            $('#editPost').validate( options );
    });




$(function () {
        $("#fileChooser1").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoadedEdit;
                reader.readAsDataURL(this.files[0]);
            }
            
        });
        
        $(".imgChoosedRemover1").click(function () {
            $('.choosedImage').attr('src', "");
            $('.imgPlus').show();
            $('.choosedImage').hide();
            $(this).hide();
        });
    });

    function imageIsLoadedEdit(e) {
        $('form#editPost .choosedImage').attr('src', e.target.result);
        $('form#editPost .choosedImage').show();
        $('form#editPost .imgPlus').hide();
        $('form#editPost .imgChoosedRemover1').show();
        
    };

//Profile Pic JS
        function handlePostSelect(evt) {
            $('#fileChooser1 img').attr('src',$('#post_img_ex').val());          
          }
         if($('#post_img_ex').length > 0){
            //document.getElementById('post_img_ex').addEventListener('change', handlePostSelect, false);
        }



</script>