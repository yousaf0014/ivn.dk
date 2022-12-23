@extends('layouts.default.app')
!-- if there are creation errors, they will show here --
@section('content')

div class=subscription-plan-mob
	div class=container
		div class=row
			div class=col-xs-12
				table
					tr
						td width=33.33% style=text-aligncenter;
							h3{{!empty($packages[0])  $packages[0]-title''}}h3

						td
						td width=33.33% style=text-aligncenter;
							h3{{!empty($packages[1])  $packages[1]-title''}}h3

						td
						td width=33.33% style=text-aligncenter;
							h3{{!empty($packages[2])  $packages[2]-title''}}h3
						td
					tr
					tr
						td style=text-alignleft;
							php echo !empty($packages[0])  html_entity_decode($packages[0]-details)''; 
						td
						td style=text-alignleft;
							php echo !empty($packages[1])  html_entity_decode($packages[1]-details)''; 
						td
						td style=text-alignleft;
							php echo !empty($packages[2])  html_entity_decode($packages[2]-details)''; 
						td
					tr
					tr
						td
							div class=pricephp echo !empty($packages[0])  html_entity_decode($packages[0]-price)'';  kr. small(Excl. moms)smalldiv
						td
						td
							div class=pricephp echo !empty($packages[1])  html_entity_decode($packages[1]-price)'';  kr. small(Excl. moms)smalldiv
						td
						td
							div class=pricephp echo !empty($packages[2])  html_entity_decode($packages[2]-price)'';  kr. small(Excl. moms)smalldiv
						td
					tr
					tr
						td
							div class=btn-block
								a href=javascript; disabled=disabled class=btn btn-primaryOpret profila
							div
							!-- div class=fancy-checkbox
								input type=checkbox class=checkbox id=checkbox-2
								label for=checkbox-2 class=checkbox-click-target smspan class=checkbox-boxspan
									Ja, jeg accepterer brugerbetingelserne og at modtage nyhedsbreve fra IVN.
								label
							div --
						td

						td
							div class=btn-block
								div class=btn-block
									a href=javascript; disabled=disabled onclick=putplanId('silver') id=silver_a class=btn btn-primary submit-formOpret profila
								div
								div class=fancy-checkbox
									input type=checkbox onclick=changeaccess('checkbox-3','silver') class=checkbox id=checkbox-3
									label for=checkbox-3 onclick=changeaccess('checkbox-3','silver') class=checkbox-click-target smspan class=checkbox-boxspan
										Jeg accepterer a href=javascript; style=text-decoration underline; data-target=#term_and_condition onclick=$('#term_and_condition').modal('show');abonnementsbetingelserne.a
									label
								div								
							div							
						td
						td
							div class=btn-block
								div class=btn-block
									a href=javascript; disabled=disabled onclick=putplanId('gold') id=gold_a class=btn btn-primary submit-formOpret profila
								div
								div class=fancy-checkbox
									input type=checkbox onclick=changeaccess('checkbox-4','gold')  class=checkbox id=checkbox-4
									label for=checkbox-4 onclick=changeaccess('checkbox-4','gold')  class=checkbox-click-target smspan class=checkbox-boxspan
										Jeg accepterer a href=javascript; style=text-decoration underline; data-target=#term_and_condition onclick=$('#term_and_condition').modal('show');abonnementsbetingelserne.a
									label
								div
							div							
						td
					tr
				table
			div
		div
	div
div
div style=displaynone
	form id=signupform method=post action={{url('subscription')}}
		input type=hidden name=_token value={{csrf_token()}} 
        input type=hidden name=first_name value={{Authuser()-first_name}} required placeholder=First name 
        input type=hidden name=last_name value={{Authuser()-last_name}} required placeholder=Last name 
        input type=hidden name=email value={{Authuser()-email}} required 
        input type=checkbox id=terms checked=checked required
        input type=hidden id=token name=reepay-token
        input type=submit id=submit-form style=displaynone;
        input type=hidden name=customer value=cut_{{Authuser()-id}}
		input type=hidden name=plan value={{getPlanID(silver)}} id=planID   
		input type=hidden name=plan_name value=basic id=planName                
    form
div

!-- popups --
div class=modal fade ivn-popups id=term_and_condition tabindex=-1 role=dialog
    div class=modal-dialog modal-md  role=document
        div class=vm-layout
            div class=vm-layout-content
                div class=vm-padding
                    div class=modal-content style-black no-border-radius no-shadow no-border no-padding-top 
                        button type=button class=close data-dismiss=modal aria-label=Close style=colorwhite
                            img src={{asset('imageswhite_close.png')}} alt=close
                        button
                        div class=modal-body 
                            div class=body-with-scroll
                                div class=col-lg-10 col-lg-offset-1 clear-before-after text-white
                                   h2 class=text-whitephp echo cmskey('payment_term_conditions_title');h2
                                    php echo cmskey('payment_term_conditions_details');
                                div                          
                            div
                            div class=clearfixdiv
                        div
                    div!-- .modal-content --
                div
            div
        div
    div!-- .modal-dialog --
div!-- .modal --
@endsection
@section('scripts')
script src=httpstoken.reepay.comtoken.jsscript
script
    var form = document.getElementById('signupform');
    var handler = reepaytoken.configure({
        key 'pub_89adef5af8474bf87ba31ab493bd7d75',
        language 'en',
        recurring true,
        token function(result) {
            console.log(JSON.stringify(result));
            document.querySelector('#token').value = result.token;
            $('#submit-form').click();
        },
        ready function() {
        	document.querySelector('#signup-button').removeAttribute('disabled');                
        },
        close function() {
            console.log('modal closed');
        }
    });

    function putplanId(plan){
    	if(plan == 'silver'){
    		$('#planID').val('{{getPlanID(silver)}}');
    		$('#planName').val('silver');
    	}else{
    		$('#planID').val('{{getPlanID(gold)}}');
    		$('#planName').val('gold');
    	}
    	handler.open();
    }

    function changeaccess(elem,name){
    	if($('#'+elem).is('checked')){
    		$('#'+name+'_a').removeAttr( disabled);
    	}else{
    		$('#'+name+'_a').attr( disabled, true );
    	}
    }
script
@endsection