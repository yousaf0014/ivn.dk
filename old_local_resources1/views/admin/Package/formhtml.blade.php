<div class="form-group">
    <label class="col-md-2" for="profilePic">Package Pic</label>
    <div class="col-md-10">
        <?php $path =  !empty($package)? asset('uploads/package/' . $package->image_path) :'';?>
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
    <label class="col-lg-2 control-label">Price</label>
    <div class="col-lg-10">
        {!! Form::text('price', Input::old('price'), array('class' => 'form-control input-sm','placeholder'=>'Price')) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Price Inc.Vat</label>
    <div class="col-lg-10">
        {!! Form::text('price_inc_vat', Input::old('price_inc_vat'), array('class' => 'form-control input-sm','placeholder'=>'price_inc_vat')) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Reepay Plan ID</label>
    <div class="col-lg-10">
        {!! Form::text('reepay_plan_id', Input::old('reepay_plan_id'), array('class' => 'form-control input-sm','placeholder'=>'Reepay Plan ID')) !!}
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
        <a class="pull-right btn btn-danger" href="{{url('admin/package')}}">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
    </div>
    <div class="col-lg-offset-1">
        <button type="button" onclick="submitMe()" class="btn btn-warning btn-sm">Save</button>                                    
    </div>
</div>