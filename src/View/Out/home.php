<?php
echo "I am for logged OUT users!<br><br>";
if(isset($_COOKIE['login'])) { echo '<div id="cookie">' . $_COOKIE['login'] . '</div>'; }
else { echo "no cookie"; }
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
