@extends('layouts.default.app')
@section('content')
<div class="cms-content bg-white">
    <div class="cms-content">       
        <div class="contact-us-elmnts">
            <div class="ctnt-elmts">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 lft gray-bg padding40 m-h-520">
                           <h2>Om IVN.dk</h2>
                            <div class="address-info">
                                <?php echo html_entity_decode($contentData->content);?>
                            </div>
                        </div>                        
                        <div class="col-sm-8 col-md-8 col-lg-8 rgt padding-left-25 no-m-p">
                            <div class="clearfix gray-bg padding40 m-h-520">
                                <h2>Skriv til os</h2>
                                <div class="contact-form-elements">
                                    <form action="{{url('contact us')}}" method="post" id="contact-us">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                        <div class="sign-up-form">
                                            <div class="clearfix m-t-20">
                                                <div class="col-lg-2">
                                                    <p>Fornavn:</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="first_name" id="first_name">
                                                </div>
                                            </div>
                                            <div class="clearfix m-t-20">
                                                <div class="col-lg-2">
                                                    <p>Efternavn:</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                                </div>
                                            </div>
                                            <div class="clearfix m-t-20">
                                                <div class="col-lg-2">
                                                    <p>E-mail:</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="clearfix m-t-20">
                                                <div class="col-lg-2">
                                                    <p>Besked:</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" rows="8" id="contact_msg" name="details"></textarea>
                                                </div>
                                            </div>
                                            <div class="clearfix m-t-20">
                                                <div class="col-lg-2">                                                      
                                                </div>
                                                <div class="col-lg-10">
                                                    <button type="submit" class="btn btn-primary" style="margin:0 auto; display:block; float:none">
                                                        Send
                                                    </button>
                                                </div>
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
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            options = {
                    rules: {
                        "first_name": "required",
                        "last_name": "required",
                        "email"     :{"required":true,'email':true},
                        "details": "required"
                    },
                    messages: {
                        "first_name": "Venligst indtast dit fornavn.",
                        "last_name": "Venligst indtast dit efternavn",
                        "email"     :{ "required" : "Venligst indtast en gyldig E-mail." , 'email' : 'Indtast venligst en gyldig E-mail', },
                        "details": "Indtast venligst en besked."
                    }
                }
                $('#contact-us').validate( options );
            });
    </script>
@endsection