@extends('layouts.default.app')
@section('content')

<div class="modal fade" id="msg-stopper-for-lower-users" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="vm-layout">
                <div class="vm-layout-content">
                    <div class="vm-padding">
                        <div class="modal-content no-border-radius no-shadow no-border  padding-left-25 padding-right-25">
                            <button type="button" class="close" data-dismiss="modal" onclick="redirectHome()" aria-label="Close">
                                <img src="{{ asset('images/icons/img-modal-close.png')}}"  alt="close">
                            </button>
                            <div class="modal-header margin-bottom-30">
                                <h4 class="modal-title">
                                    <?php echo  cmskey('my_subscription_page_popup_title');?>
                                </h4>
                            </div>
                            <div class="modal-body padding-bottom-70">
                                <div class="desc margin-bottom-20">
                                    <p class="text-center f-s-18 line-height-30">
                                        <?php echo  cmskey('my_subscription_page_popup_details');?>
                                    </p>
                                </div>
                                <div class="popup-buttons text-center margin-top-70">
                                    <a href="{{url('subscription')}}" style="margin:5px 10px;" class="btn btn-primary btn-popup min-width-300">Opgrader nu</a>
                                    <a href="{{url('home')}}" style="margin:5px 10px;" class="btn btn-primary btn-popup min-width-300">Ikke nu</a>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div>
                </div>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
    function redirectHome(){
        window.location = "{{url('home')}}";
    }
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        var isEscape = false;
        if ("key" in evt) {
            isEscape = (evt.key == "Escape" || evt.key == "Esc");
        } else {
            isEscape = (evt.keyCode == 27);
        }
        if (isEscape) {
            evt.preventDefault();
            window.location = "{{url('subscription')}}";
        }
    };
	$(document).ready(function(){
			$("#msg-stopper-for-lower-users").modal({
			  backdrop:"static",
			  keyboard: false
			});		
			showpopup();
	});

	function showpopup(){
		$('#msg-stopper-for-lower-users').modal('show');
	}
</script>
@endsection