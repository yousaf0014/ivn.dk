<div class="form-group">
    <label class="col-lg-2 control-label">Title For Link</label>
    <div class="col-lg-10">
        {!! Form::text('link_title', Input::old('link_title'), array('class' => 'form-control input-sm','placeholder'=>'Title for link')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Page Title</label>
    <div class="col-lg-10">
        {!! Form::text('title', Input::old('title'), array('class' => 'form-control input-sm','placeholder'=>'Page Title')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Meta Title Content</label>
    <div class="col-lg-10">
        {!! Form::text('meta_title_content', Input::old('meta_title_content'), array('class' => 'form-control input-sm','placeholder'=>'Meta Title')) !!}
    </div>
</div>

<div class="form-group">
    <label for="inputName" class="col-lg-2 control-label">Page Keywords</label>
    <div class="col-lg-10">
        {!! Form::textarea('page_keywords', Input::old('page_keywords'), array('class' => 'form-control input-sm')) !!}
    </div>
</div>

<div class="form-group">
    <label for="inputName" class="col-lg-2 control-label">Page Description</label>
    <div class="col-lg-10">
        {!! Form::textarea('page_description', Input::old('page_description'), array('class' => 'form-control input-sm')) !!}
    </div>
</div>

<div class="form-group">
    <label for="inputName" class="col-lg-2 control-label">Businee Name</label>
    <div class="col-lg-10">

        {!! Form::select('parent_id', $bustinessList, Input::old('parent_id') , array('class' => 'form-control input-sm')) !!}
    </div>
</div>

<div class="form-group" style="display:none;">
    <label for="inputName" class="col-lg-2 control-label">Show on Homepage</label>
    <div class="col-lg-10">
        {!! Form::radio('show_on_homepage', 1) !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('show_on_homepage', 0) !!} No                    
    </div>
</div>

<div class="form-group" style="display:none;">
    <label for="inputName" class="col-lg-2 control-label">Show On Top</label>
    <div class="col-lg-10">
        {!! Form::radio('show_on_top', 1) !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('show_on_top', 0) !!} No
    </div>
</div>

<div class="form-group" style="display:none;">
    <label for="inputName" class="col-lg-2 control-label">Show On Bottom</label>
    <div class="col-lg-10">
        {!! Form::radio('show_on_bottom', 1) !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('show_on_bottom', 0) !!} No                    
    </div>
</div>

<div class="form-group" style="display:none;">
    <label for="inputName" class="col-lg-2 control-label">Footer Links</label>
    <div class="col-lg-10">
        {!! Form::radio('show_in_footer', 1) !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::radio('show_in_footer', 0) !!} No                    
        
    </div>
</div>

<div class="form-group">
    <label for="inputName" class="col-lg-2 control-label">Short Description</label>
    <div class="col-lg-10">
        {!! Form::textarea('short_description', Input::old('short_description'), array('class' => 'form-control input-sm')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Content:</label>
    <div class="col-lg-10">                         
        {!! Form::textarea('content', Input::old('content'), array('id'=>'editor','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
        <textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Extra Content:</label>
    <div class="col-lg-10">                         
        {!! Form::textarea('extra_content', Input::old('extra_content'), array('id'=>'editor1','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
        <textarea id="text_content1" class="form-control input-sm btn-toolbar"></textarea>
    </div>
</div>

<div class="form-group">                
    <div class="col-lg-offset-1 col-lg-1">
        <a class="pull-right btn btn-danger" href="{{url('admin/Contents')}}">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
    </div>
    <div class="col-lg-offset-1">
        <button type="button" onclick="submitMe()" class="btn btn-primary btn-sm">Save</button>                    
    </div>
</div>