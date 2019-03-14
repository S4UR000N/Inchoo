<?php
if(array_key_exists("invalid", $viewData)) { echo '<script>var $alert ="' . $viewData['invalid'][0] . '";</script>'; }
else if(array_key_exists("uploaded", $viewData)) {
	if($viewData['uploaded']) { echo '<script>var $alert = "File Uploaded!"</script>'; }
	else if(!$viewData['uploaded']) { echo '<script>var $alert = "File Upload Failed!");</script>'; }
}
?>

<!-- MODALS.START -->
<!-- MODALS.END -->


<!-- Upload Button -->
<div class="container-fluid row justify-content-center bg-primary align-items-center" style="height: 200px;">
 <form action="" method="POST" enctype="multipart/form-data" class="img_up column justify-content-center">
	<div id="img_up_ctrl_con"><label for="img_up">UPLOAD</label></div>
	<input id="img_up" type="file" name="img_up" accept="image/jpeg, image/jpg, image/png" style="display: none;" onchange="img_up"/>
 </form>
</div>

<div>FILES HERE</div>


<style>
#img_up_ctrl_con { margin-left: 60px; }
#img_up_ctrl_con label {
 width: 250px;
 height: 100px;

 font-size: 35px;

 border-radius: 5px;
 background-color: #f8f9fa;

 text-align: center;
 line-height: 100px;
}

#img_up_ctrl_con .btn {
	width: 125px;
	height: 50px;
}
</style>

<!-- Script -->
<script>
// Upload File
function img_up() {
  var $iu = $("#img_up");
	var $iucc = $("#img_up_ctrl_con");

  if($iu[0].files.length !== 0 ) {
		$iucc.addClass("btn-group");
    $iucc.html("<button class='btn bg-dark text-light' type='submit'>Submit</button><button class='btn bg-warning' type='button' onclick='rewind_upload()'>Cancel</button>");
  }
}

// Rewind Upload
function rewind_upload() { window.location.replace("http://inchoo.local/management"); }

/* Launch jQ */
$("document").ready(function() {
  $("#img_up").change(img_up);

	setTimeout(myAlert, 1000)
});


function myAlert() { if(typeof $alert !== 'undefined') { alert($alert); } }
</script>
