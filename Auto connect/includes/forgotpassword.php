<?php

?>






<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "forgot_email_check.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>







<div class="modal fade" id="forgotpassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Password Recovery</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="forgotpassword_wrap">
            <div class="col-md-12">
              <form name="chngpwd" method="post" onSubmit="return valid();">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" onblur="checkAvailability()" id="email" placeholder="Your Email address*" required="">
                  <span id="user-availability-status" style="font-size:12px;"></span>
                </div>
  
                <div class="form-group">
                  <input type="submit" value="Reset My Password" name="update" class="btn btn-block">
                </div>
              </form>
              <div class="text-center">
                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>