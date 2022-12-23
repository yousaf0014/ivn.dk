@extends('layouts.admin.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Contents
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/Contents')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" class="btn btn-warning pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('/Contents')}}">Contents</a></li>
                <li class="active">Contents Reorder</li>
            </ol>
            {{ Html::ul($errors->all()) }}
            <div class="title fltL">Content Management</div>    
            
            {!! Form::open(array('url' => 'Contents/updateOrder/','id'=>'add_content','name'=>'add_content','class'=>'form-horizontal')) !!}
                <div class="dd" id="reorder-div">    
                  <ol class="dd-list">
                  <?php foreach($contentsList as $id=>$title){?>
                        <li class="dd-item" data-id="<?php echo $title['id'] ;?>">

                        <div class="dd-handle"><?=$title['title']?></div>
                        <?php if(!empty($title['child'])){?>
                            <ol class="dd-list">
                            <?php foreach($title['child'] as $childID =>$childTitle){ ?>
                                    <li class="dd-item" data-id="<?php echo $childTitle['id']?>">
                                        <div class="dd-handle"><?php echo $childTitle['title']; ?></div>
                                    </li>
                            <?php } ?>
                            </ol>
                        <?php } ?>
                   <?php } ?>        
                  </ol>
                  <input type="hidden" name="order" value="" id="order-arr">
                </div>
                <div class="col-lg-offset-4 col-lg-5">
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                </div>
            {!! Form::close() !!}
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
                    group:0,
                    maxDepth:2
                })
                .on('change', updateOutput);        
                updateOutput($('#reorder-div').data('output', $('#order-arr')));
            });
     </script>
@endsection