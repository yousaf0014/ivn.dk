@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Reorder Content Images</h3></div>               
                <div class="pull-right" style="color:black">
                    <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/ContentImages',$content->id)}}">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Contents')}}">Contents</a></li>
                <li><a href="{{url('admin/ContentImages',$content->id)}}">Content Images</a></li>
                <li class="active">Images Reorder</li>
            </ol>
            {{ Html::ul($errors->all()) }}
            <div class="title fltL">Content Images Management</div>    
            <div class="clearfix"></div>
            {!! Form::open(array('url' => 'admin/ContentImages/updateOrder/'.$content->id,'id'=>'add_content','name'=>'add_content','class'=>'form-horizontal')) !!}
                <div class="dd" id="reorder-div">    
                  <ol class="dd-list">
                  <?  foreach($contentImagesList as $id=>$title){?>
                      <li class="dd-item" data-id="{{$id}}">
                          <div class="dd-handle"><?=$title;?></div>
                      </li>
                    <? } ?>        
                  </ol>
                  <input type="hidden" name="order" value="" id="order-arr">
                </div>
                <div class="col-lg-offset-4 col-lg-5">
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                </div>
            {!! Form::close() !!}
        
        </div>
    </div>
</div>

@endsection
@section('css')
    <link rel="stylesheet" media="screen" href="{{asset('css/nastedable.css')}}" />
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.nestable.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                var updateOutput = function(e){
                    var list   = e.length ? e : $(e.target),
                        output = list.data('output');
                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }
                };
                // activate Nestable for list 1
                $('#reorder-div').nestable({
                    maxDepth:1
                })
                .on('change', updateOutput);        
                updateOutput($('#reorder-div').data('output', $('#order-arr')));
            });
     </script>
@endsection