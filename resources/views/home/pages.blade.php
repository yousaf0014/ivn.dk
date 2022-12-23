@extends('layouts.default.app')
@section('content')
    <div class="category-landing-desc bg-white" style="margin-top:0px;margin-bottom:0px;padding-top:20px;padding-bottom:50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if(!empty($contentData->content)){
                        echo html_entity_decode($contentData->content);
                    }else{
                        echo $contentData;
                    }?>
                </div>
            </div>
        </div>
    </div>    
<div class="clearfix">
<footer class="container-fluid text-center" style="background: #000;color:white;padding:10px 0px 0px 0px;">
  <p> Copyright ©  IVN.dk</p>
</footer>
</div>
@endsection
