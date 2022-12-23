<div class="form-group">
    <label class="col-lg-2 control-label">CMS key</label>
    <div class="col-lg-10">
        {!! Form::text('key', Input::old('key'), array('class' => 'form-control input-sm','placeholder'=>'Key')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Content:</label>
    <div class="col-lg-10">
        {!! Form::textarea('details', Input::old('details'), array('id'=>'editor','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
        <textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
    </div>
</div>          
<div class="form-group">                
    <div class="col-lg-offset-1 col-lg-1">
        <a class="pull-right btn btn-danger" href="{{url('admin/Texts')}}">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
    </div>
    <div class="col-lg-offset-1">
        <button type="button" onclick="submitMe()" class="btn btn-primary btn-sm">Save</button>                                    
    </div>
</div>