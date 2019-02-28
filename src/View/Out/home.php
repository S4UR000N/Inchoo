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
	console.log("this part works");
}
</script>
