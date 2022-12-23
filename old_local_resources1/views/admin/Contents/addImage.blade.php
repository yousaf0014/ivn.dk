 <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="pull-left">Upload Pic</h4>
        <a href="javascript:;" onclick="jQuery('#myModal').modal('hide');" class="glyphicon glyphicon-remove-circle pull-right text-primary f20"></a>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        {!! Form::open(array('url' => 'admin/Contents/uploadImage/'.$content->id,'id'=>'add_image','name'=>'add_image','files'=>'true','class'=>'form-horizontal')) !!}
        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">Select Pic</label>
            <div class="col-lg-10">
                <input type="file" name="image" id="image" size="17" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">&nbsp;</label>
            <div class="col-lg-10">
                <div id="imageExtError" class="error" style="display: none;">
                    image_file_required_msg
                </div>
                <div id="imageTypeError" class="error" style="display: none;">
                    valid_image_file_is_required
                </div>
            </div>
        </div> 
        <div class="clearfix"></div>
        <div class="col-lg-offset-9">
            <a class="btn btn-primary btn-sm" onclick="submitME();">Upload</a>
        </div>
        {!! Form::close() !!}        
    </div>
</div>
 <script type="text/javascript">
    function submitME(){
        $('.error').hide();
        var ext = $('#image').val().split('.').pop().toLowerCase();
        if(jQuery('#image').val() == ''){
            jQuery('#imageExtError').show();
            return false;
        }
        else if($.inArray(ext, ['gif','png','jpg','jpeg','pjpeg','bmp']) == -1) {
            $('#imageTypeError').show();
            return false;
        }
        else {
            jQuery('#loading').show();
            jQuery('#add_image').submit();
        }
    }
</script>