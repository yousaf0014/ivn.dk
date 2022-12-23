<div class="form-group">
    <label class="col-lg-2 control-label">Title</label>
    <div class="col-lg-10">
        {!! Form::text('text', Input::old('text'), array('class' => 'form-control input-sm','placeholder'=>'Title')) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Additional Text</label>
    <div class="col-lg-10">
        {!! Form::text('add_text', Input::old('add_text'), array('class' => 'form-control input-sm','placeholder'=>'Additional Text')) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Basic Plan</label>
    <div class="col-lg-10">
        {!! Form::radio('basic', 1,Input::old('basic') =="1" ? true:'') !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('basic', 0 ,Input::old('basic') =="0" ? true:'') !!} No                    
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">{{getPlanTitle('silver')}} Plan</label>
    <div class="col-lg-10">
        {!! Form::radio('silver', 1, Input::old('silver') =="1" ? true:'') !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('silver', 0 , Input::old('silver') =="1" ? true:'') !!} No                    
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">{{getPlanTitle('gold')}} Plan</label>
    <div class="col-lg-10">
        {!! Form::radio('gold', 1 ,Input::old('gold') =="1" ? true:'') !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('gold', 0 ,Input::old('gold') =="0" ? true:'') !!} No                    
    </div>
</div>
<div class="form-group">
    <label for="inputName" class="col-lg-2 control-label">Details</label>
    <div class="col-lg-10">
        {!! Form::textarea('details', Input::old('details'), array('class' => 'form-control input-sm')) !!}
    </div>
</div>
<div class="form-group">                
    <div class="col-lg-offset-1 col-lg-1">
        <a class="pull-right btn btn-danger" href="{{url('admin/PackageOptions')}}">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
    </div>
    <div class="col-lg-offset-1">
        <button type="button" onclick="submitMe()" class="btn btn-warning btn-sm">Save</button>                                    
    </div>
</div>