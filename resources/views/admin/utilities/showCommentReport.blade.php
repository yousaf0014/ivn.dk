 <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="pull-left">Reported Comment</h4>
        <a href="javascript:;" onclick="jQuery('#myModal').modal('hide');" class="glyphicon glyphicon-remove-circle pull-right text-primary f20"></a>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div style="padding:20px;">
                    <?php if($commentD->image_path){?>
                        <img class="img-fluid rounded" src="{{ asset('uploads/Comment/' . $commentD->image_path) }}" alt="">
                    <?php } ?>
                    <div class="post-content">
                        <!-- Post Content -->
                        <p>
                           <?php  echo html_entity_decode($commentD->comment) ?>
                        </p>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>