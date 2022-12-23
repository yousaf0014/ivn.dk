 <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="pull-left">Update Pic Info</h4>
        <a href="javascript:;" onclick="jQuery('#myModal').modal('hide');" class="glyphicon glyphicon-remove-circle pull-right text-primary f20"></a>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        {!! Form::open(array('url' => 'admin/Contents/updateImageInfo/'.$content->id,'id'=>'add_image','name'=>'add_image','files'=>'true','class'=>'form-horizontal')) !!}
            <div class="form-group">
                <label class="control-label col-lg-3">Title Image</label>
                <div class="col-lg-8">                    
                    <input type="text" class="form-control input-sm" name="image_title" value="{{$content->image_title}}"  />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">Image Details</label>
                <div class="col-lg-8">                    
                    <textarea name="image_details" rows="5" class="form-control input-sm">{{$content->image_details}}</textarea>
                </div>
            </div>
            <div class="form-group">                                
                <div class="col-lg-offset-3">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
        {!! Form::close() !!}        
    </div>
</div>

<script type="text/javascript" src="{{asset('js/jquery.form.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>

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