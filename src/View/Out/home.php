<?php
if(isset($_COOKIE['login']) && isset($_SESSION['user_name'])) { echo '<div id="cs">' . $_COOKIE['login'] . "::" . $_SESSION['user_name'] . '</div>'; }
else { echo "meh"; }
?>


<button id="btn" class="btn btn-dark btn-lg" style="color: white; position: relative; left: 49%;">Click Me (:</button>

<script>
// Windows width & height
var $window_height = $(window).height();

// Header's height
var $header_height = $("#header").outerHeight();

// #read_create_delete's height
$btn_position = ($window_height - $header_height) / 2;
$('#btn').css({ "top": $btn_position });
</script>
