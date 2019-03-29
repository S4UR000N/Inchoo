<!-- MODALS.START -->

<!-- Preview File Modal -->
<div class="modal fade" id="preview_file">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Preview</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="preview_file_body" class="modal-body row justify-content-center"></div>

   <!-- Modal footer -->

  </div>
 </div>
</div>

<!-- Preview Info Modal -->
<div class="modal fade" id="preview_info">
 <div class="modal-dialog modal-lg">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Info</h1>
    <button class="close" data-dismiss="modal">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="preview_info_body" class="modal-body row justify-content-center"></div>

   <!-- Modal footer -->

  </div>
 </div>
</div>


<!-- MODALS.END -->


<!-- Hidden Table -->
<table class="table table-dark table-bordered table-striped" style="display: none;">
 <thead>
  <tr>
   <th>Name</th>
   <th class="text-warning">Preview</th>
   <th class="text-primary">Download</th>
   <th class="text-info">Info</th>
  </tr>
 </thead>
 <tbody>
 </tbody>
</table>

<!-- Trigger Ajax Button -->
<button id="btn" class="btn btn-dark btn-lg" style="color: white; position: relative; left: 49%;" onclick="AjaxGetAllFiles();">Click Me (:</button>

<!-- Style -->
<style>
.table th { text-align: center; }
.table td { text-align: center; }
i { font-size: 18px; }

.info:hover { cursor: cell; }
</style>

<script>
// Windows width & height
var $window_height = $(window).height();

// Header's height
var $header_height = $("#header").outerHeight();

// #read_create_delete's height
$btn_position = ($window_height - $header_height) / 3;
$('#btn').css({ "top": $btn_position });

// Triger for Ajax Request
function AjaxGetAllFiles() {
	var AjaxGetAllFilesRequest = 'AjaxController:AjaxGetAllFiles';
	$.ajax({
	  url: 'http://inchoo.local/index.php',
	  type: 'POST',
		data: { ajax:AjaxGetAllFilesRequest },
	  success:function(data) {
			if(data == 0) { $('#btn').html("AJAX FAILED!!!"); }
			else {
				$("tbody").append(data);
        setEventsAfterAjax();
        $("table").css({ "display": "table" })
        $('#btn').remove();
			}
		}
	});
}

/* Modals Script */
// Set Preview Image
var preview_file_body = document.getElementById('preview_file_body');
var preview_info_body = document.getElementById('preview_info_body');

// Set Preview Image & Preview Info
function setEventsAfterAjax() {
	$(".preview_file").click(function() {
		var user_id = this.getAttribute('data-user_id');
	  var file_id = this.getAttribute('data-file_id');
	  var file_name = this.getAttribute('data-file_name');
	  preview_file_body.innerHTML = "<img src='uploads/"+ user_id + file_name + "' data-file_id="+ file_id+ " data-file_name="+ file_name+ "/>";
	});
  $(".preview_info").click(function() {
    var user_name = this.getAttribute('data-user_name');
    var user_email = this.getAttribute('data-user_email');
    preview_info_body.innerHTML = "<div class='column justify-content-center'><div class='text-info'>User Name: <span class='text-dark' style='text-decoration: underline;'>"+ user_name+ "</span></div>"+ "<div class='text-info'>User Email: <span class='text-dark' style='text-decoration: underline;'>"+ user_email+ "</span></div></div>";
  });
}
</script>
