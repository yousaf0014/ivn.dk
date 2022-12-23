<div class="vm-layout-content">
    <div class="vm-padding">
        <div class="modal-content no-border-radius no-shadow no-border  padding-left-85 padding-right-85">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('images/icons/img-modal-close.png')}}" alt="close">
            </button>
            <div class="modal-header margin-bottom-55">
                <h4 class="modal-title">
                    Edit Comment
                </h4>
            </div>
            <div class="modal-body padding-bottom-100" style="overflow:hidden;">
                <div class="create-post-elmnts">
                    <div class="create-post-body active">
                        <div class="create-post-form-elmnts">
                            <form action="{{url('/user/comment',$post->id)}}/{{$commentData->id}}" method="post" enctype="multipart/form-data" id="editPost">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <input type="hidden" name="edit" value="1" />
                                <h3>Opret Comment</h3>
                                <div class="full-box">
                                    <label class="full">Tekst</label>
                                    <textarea name="comment"  cols="5">{{$commentData->comment}}</textarea>
                                </div>
                                <div class="full-box">
                                    <label class="full">
                                        Billeder:
                                    </label>
                                    <div class="fileChooser">
                                        <input type="file" name="image_path" class="file">
                                        <img src="{{ asset('images/icons/img-plus-white.png') }}" alt="plus icon">
                                    </div>
                                </div>
                                <div class="full-box">
                                    <div class="text-center">
                                        <input type="submit" value="Opret comment" class="btnSubmitCreatePost btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.chosen-select1').chosen({width: '55%'} );
            options = {
                    rules: {
                        "details": "required",                        
                    },
                    messages: {
                        "details": "Please enter details",                        
                    }
                }
                $('#editPost').validate( options );
            });

</script>