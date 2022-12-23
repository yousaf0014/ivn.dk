@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form class="form-horizontal" id="forgetPassword" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-mail:</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>            
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','ForgetEmailSnet');" class="btn btn-primary">
                Nulstil kodeord
            </button>
        </div>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
    var options = {
        target: '#popup-forgot-password .pop-body', // target element(s) to be updated with server response
        success: showResponse
    };

    $('#forgetPassword').ajaxForm(options);
});

function showResponse(responseText, statusText){
    if($('#popup-forgot-password .help-block').length > 0){
        var options = {
            target: '#popup-forgot-password .pop-body', // target element(s) to be updated with server response
            success: showResponse
        };
        $('#popup-forgot-password .pop-body #forgetPassword').ajaxForm(options);
    }else{
        $('#popup-forgot-password div.pop-body').attr('style',"text-align:center;")
        $('#popup-forgot-password div.pop-body').css('margin-bottom','25px');
        $('#popup-forgot-password .pop-body').html('<span style="color:white;margin:auto;font-size: 20px;font-weight:300;margin-bottom: 25px;">{{cmskey("email_sent_check_inbox")}}</span>');
        $('#details').hide();
    }
}
</script>