<div class="form-group">
    <label class="col-md-2" for="profilePic">Category Pic</label>
    <div class="col-md-10">
        <?php $path =  !empty($category)? asset('uploads/category/' . $category->image_path) :'';?>
        <div id="profile-pic">
            <img width="75" alt="No Image" src="{{$path}}">
        </div>
        <input type="file" name="image_path" id="profilePic" accept='image/*'>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Title</label>
    <div class="col-lg-10">
        {!! Form::text('title', Input::old('title'), array('class' => 'form-control input-sm','placeholder'=>'Title')) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Details:</label>
    <div class="col-lg-10">
        {!! Form::textarea('details', Input::old('details'), array('id'=>'editor','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
        <textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
    </div>
</div>


<div class="form-group">                
    <div class="col-lg-offset-1 col-lg-1">
        <a class="pull-right btn btn-danger" href="{{url('admin/Category')}}">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
    </div>
    <div class="col-lg-offset-1">
        <button type="button" onclick="submitMe()" class="btn btn-warning btn-sm">Save</button>                                    
    </div>
</div>