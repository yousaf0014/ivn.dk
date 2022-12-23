<div id="forget-password" class="modal fade" role="dialog" tabindex='-1'>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content ex-dark-grey" style="color: white;font-weight: 300;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      
      <div class="modal-body">
      		<h2>Glemt din adgangskode?</h2>
        <div class="col-lg-10 col-lg-offset-1">
         <p class="text-center">Indtast din E-mail, så sender vi et link som du skal bruge til at danne et nyt kodeord</p>
       
       <form>
        <div class="col-lg-2">Email:-</div>
        	<div class="col-lg-10"><input type="email" id="forget_password_email" name="forget_password_email" class="form-control"/>
            	<input type="hidden" name="action" id="action" value="FORGET_PASSWORD" />
            </div>
            <div class="col-lg-3 pull-right" style="margin-top: 10px;">
       			 <button  type="submit"class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Send</button>
        	</div>
      </form>
        </div>
      
      <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>-->
    </div>
</div>
</div>