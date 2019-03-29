<?php
// File Upload Errors and Feedback
if(array_key_exists("invalid", $viewData)) { echo '<script>var $alert ="' . $viewData['invalid'][0] . '";</script>'; }
else if(array_key_exists("uploaded", $viewData)) {
	if($viewData['uploaded']) { echo '<script>var $alert = "File Uploaded!"</script>'; }
	else if(!$viewData['uploaded']) { echo '<script>var $alert = "File Upload Failed!");</script>'; }
}

// File Deletion Errors and Feedback
if(array_key_exists("deleted", $viewData)) {
	if($viewData['deleted']) { echo '<script>var $alert = "File Deleted!"</script>'; }
	else if(!$viewData['deleted']) { echo '<script>var $alert = "File Deletion Failed!");</script>'; }
}

?>

<!-- MODALS.START -->

<!-- Preview File Modal -->
<div class="modal fade" id="preview">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Preview</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="preview_body" class="modal-body row justify-content-center"></div>

   <!-- Modal footer -->

  </div>
 </div>
</div>


<!-- Confirm Deletion Modal -->
<div class="modal fade" id="delete">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Delete File</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="delete_file_body" class="modal-body row justify-content-center">
	  <form id="delete_file_form" class="row justify-content-center" action="" method="POST">
		 <div class="btn-group" style="padding-left: 25%;">
		  <button class='btn bg-dark text-light' type='submit' name='delete' style="font-size: 20px;">Delete</button>
			<button class='btn bg-warning' type='button' data-dismiss="modal" style="font-size: 20px;">Cancel</button>
		 </div>
	  </form>
	 </div>

   <!-- Modal footer -->

  </div>
 </div>
</div>

<!-- MODALS.END -->


<!-- Upload Button -->
<div class="container-fluid row justify-content-center bg-primary align-items-center" style="height: 200px;">
 <form action="" method="POST" enctype="multipart/form-data" class="img_up column justify-content-center">
	<div id="img_up_ctrl_con"><label for="img_up">UPLOAD</label></div>
	<input id="img_up" type="file" name="img_up" accept="image/jpeg, image/jpg, image/png" style="display: none;" onchange="img_up"/>
 </form>
</div>

<table class="table table-dark table-bordered table-striped">
 <thead>
  <tr>
   <th>Name</th>
   <th class="text-warning">Preview</th>
   <th class="text-primary">Download</th>
	 <th class="text-danger">Delete</th>
  </tr>
 </thead>
 <tbody>
 	<?php if(array_key_exists("viewFiles", $viewData)) {
 		foreach($viewData['viewFiles'] as $vd) {
			if($vd['user_id'] == $_SESSION['user_id']) {
				echo "<tr>" .
							"<td>" . $vd['file_name'] . "</td>" .
							"<td class='preview_init' data-user_id='" . $vd['user_id'] . "'" . "data-file_id='" . $vd['file_id'] . "'" . "data-file_name='" . $vd['file_name'] . "' " . "data-toggle='modal' " . "data-target='#preview' " . "><i class='fas fa-eye text-warning'></i></td>" .
							"<td><a href='http://inchoo.local/uploads/" . $vd['user_id'] . $vd['file_name'] . "' download>" . "<div><i class='fas fa-download text-primary'></i></div></a></td>" .
							"<td class='delete' data-user_id='" . $vd['user_id'] . "'" . "data-file_id='" . $vd['file_id'] . "'" . "data-file_name='" . $vd['file_name'] . "' " . "data-toggle='modal' " . "data-target='#delete' " . "onclick='pass_data(this)'><i class='fas fa-fire text-danger'></i></div></td>" .
						 "</tr>";
			}
			else {
				echo "<tr>" .
							"<td>" . $vd['file_name'] . "</td>" .
							"<td class='preview_init' data-user_id='" . $vd['user_id'] . "'" . "data-file_id='" . $vd['file_id'] . "'" . "data-file_name='" . $vd['file_name'] . "' " . "data-toggle='modal' " . "data-target='#preview' " . "><i class='fas fa-eye text-warning'></i></td>" .
							"<td><a href='http://inchoo.local/uploads/" . $vd['user_id'] . $vd['file_name'] . "' download>" . "<div><i class='fas fa-download text-primary'></i></div></a></td>" .
							"<td class='text-danger'>Not Owner</td>" .
						 "</tr>";
			}
		}
	} ?>
 </tbody>
</table>

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
.table th { text-align: center; }
.table td { text-align: center; }
.table .delete { cursor: url('http://inchoo.local/Layout/Assets/Icons/crosshair_small.png'), default; }
i { font-size: 18px; }
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


function checking(i, len) {
	var form = document.getElementById("delete_file_form")
	console.log(i);
	console.log(len);
	console.log(form);
}

// Clean data from form
function clean_data() {
	//$(".input").remove();
	var input = document.getElementsByClassName("input");
	if(input.length > 0) {
		while(input.length > 0) {
			input[(input.length - 1)].remove();
		}
	}
}

// Pass Data to form
function pass_data(me) {
	clean_data();
	var $delete_file_form = $("#delete_file_form");
	var user_id = me.getAttribute("data-user_id");
	var file_id = me.getAttribute("data-file_id");
	var file_name = me.getAttribute("data-file_name");

	var data = "<input class='input' name='user_id' value='"+ user_id+ "' style='display: none;'/>"+
						 "<input class='input' name='file_id' value='"+ file_id+ "' style='display: none;'/>"+
						 "<input class='input' name='file_name' value='"+ file_name+ "' style='display: none;'/>";

	$delete_file_form.append(data);
}

/* Launch jQ */
$("document").ready(function() {
  $("#img_up").change(img_up);

	setTimeout(myAlert, 1000)
});


function myAlert() { if(typeof $alert !== 'undefined') { alert($alert); } }

/* Modals Script */
// Set Preview Image
var preview_body = document.getElementById('preview_body');
$(".preview_init").click(function() {
	var user_id = this.getAttribute('data-user_id');
  var file_id = this.getAttribute('data-file_id');
  var file_name = this.getAttribute('data-file_name');
  preview_body.innerHTML = "<img src='uploads/"+ user_id + file_name + "' data-file_id="+ file_id+ " data-file_name="+ file_name+ "/>";
});
</script>
