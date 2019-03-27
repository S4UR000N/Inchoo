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

<!-- MODALS.END -->


<!-- Hidden Table -->
<table class="table table-dark table-bordered table-striped" style="display: none;">
 <thead>
  <tr>
   <th>Name</th>
   <th class="text-warning">Preview</th>
   <th class="text-primary">Download</th>
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
var preview_body = document.getElementById('preview_body');

function setEventsAfterAjax() {
	$(".preview_init").click(function() {
		var user_id = this.getAttribute('data-user_id');
	  var file_id = this.getAttribute('data-file_id');
	  var file_name = this.getAttribute('data-file_name');
	  preview_body.innerHTML = "<img src='uploads/"+ user_id + file_name + "' data-file_id="+ file_id+ " data-file_name="+ file_name+ "/>";
	  $("#delete_image").click(function() {
	    delete_image(file_id, file_name);
	  });
	});
}
</script>
