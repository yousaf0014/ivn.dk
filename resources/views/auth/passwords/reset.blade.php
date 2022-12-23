<?php $title = 'Reset Password';?>
@extends('layouts.default.app')
@section('content')
<div class="content-area reset-password-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <p class="text-center"><?php echo cmskey('password_reset_page_message');?></p>
            </div>
            <div class="clearing"></div>
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                <div class="frm-rest-password">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="frm-heading"><?php echo cmskey('password_reset_page_header');?></div>
                        <div class="frm-contents">
                            <div class="form-group">
                                <label class="col-sm-5 col-xs-12">Email*:</label>
                                <div class="col-xs-12 col-sm-7">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <div class="frm-field-error text-right">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 col-xs-12">Adgangskode*:</label>
                                <div class="col-xs-12 col-sm-7">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 col-xs-12">Bekraeft Adgangskode*:</label>
                                <div class="col-xs-12 col-sm-7">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','PasswordRest');" value="Gem" class="btn btn-primary btnSubmt btnMinMax">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- footer start -->
    <!-- footer end -->
    <script>
        $(document).ready(function(){
         $('body').addClass('bg-white');
        });
    </script>
@endsection