<button id="btn" class="btn btn-dark btn-lg" style="color: white; position: relative; left: 49%;" onclick="AjaxGetAllFiles();">Click Me (:</button>

<script>
// Windows width & height
var $window_height = $(window).height();

// Header's height
var $header_height = $("#header").outerHeight();

// #read_create_delete's height
$btn_position = ($window_height - $header_height) / 2;
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
				console.log(data);
			}
		}
	});
}
</script>
