<?php
// Password Change Errors and Feedback
if(array_key_exists("Valid", $viewData)) {
	if($viewData['Valid']) { echo '<script>var $alert = "Password Changed!"</script>'; }
	else if(!$viewData['Valid']) { echo '<script>var $alert = "Password Change Failed!");</script>'; }
}

if(array_key_exists("AccountRemovalFailed", $viewData)) {
  if($viewData["AccountRemovalFailed"]) { echo '<script>var $alert = "Account Removal Failed!");</script>'; }
}
?>

<!-- MODALS.START -->

<!-- Preview File Modal -->
<div class="modal fade" id="remove">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-4"></span>
    <h1 class="col-sm-7">Remove Account</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="remove_body" class="modal-body row justify-content-center">
    <form method="post" action="">
     <?php echo "<input type='text' name='remove_account' value='" . $_SESSION['user_id'] . "'/>"; ?>
     <div class="btn-group">
      <button class='btn bg-dark text-light' type='submit' style="font-size: 20px;">Confirm</button>
      <button class='btn bg-warning' type='button' data-dismiss="modal" style="font-size: 20px;">Cancel</button>
     </div>
    </form>
   </div>

   <!-- Modal footer -->

  </div>
 </div>
</div>

<!-- MODALS.END -->

<!-- Spacing -->
<br /><br /><br /><br />

<!-- Form -->
<div class="d-flex justify-content-center">
 <form class="change d-flex flex-column" method="post" action="">
  <h1 class="header bg-dark rounded mx-auto p-3" style="color: white;">Change Password</h1>
   <?php // Display Validation Errors here
   if(isset($viewData) && !empty($viewData['Error'])) {
    echo '<div class="Error bg-dark text-danger mx-auto border rounded px-3 pt-3 pb-1">';
    foreach($viewData['Error'] as $err) {
     echo "<p>$err</p>";
    }
    echo '</div>';
   }
   ?>

<div class="label">Change Password</div>
<input class="input" type="password" name="user_change_password" value=""/>

<div class="label">Confirm Changed Password</div>
<input class="input" type="password" name="user_confirm_changed_password" value=""/>

<button class="btn text-light" type="submit" style="font-size: 20px; background-color: #4da3ff">Change</button>
</form>
</div>

<!-- Spacing -->
<br><br>

<!-- Form -->
<div class="d-flex justify-content-center"><button class="btn btn-danger" data-toggle='modal' data-target='#remove' style="font-size: 20px; color: black;">Remove Account</button></div>

<!-- Style -->
<style>
.Error {
width: 100%;
}
.input { border-radius: 5px; }

#remove_body input { display: none; }
</style>

<script>
/* Launch jQ */
$("document").ready(function() {
	setTimeout(myAlert, 1000)
});

function myAlert() { if(typeof $alert !== 'undefined') { alert($alert); } }
</script>
