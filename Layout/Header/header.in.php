<!-- Header -->
<div id="header" class="container-fluid row bg-dark">
 <img id="header_circle" class="mt-1 mb-1 ml-1" src="Assets/Icons/header_circle.png">

 <div id="navBtns" class="container row align-items-center justify-content-around col-11">
  <a class="header_pages btn border-top-0 border-bottom-0" href="http://os.local/you">You</a>
  <a class="header_pages btn border-top-0 border-bottom-0" href="http://os.local/search">Search</a>
  <a class="header_pages btn border-top-0 border-bottom-0" href="http://os.local/signout">Sign Out</a>
 </div>
</div>

<!-- Script -->
<script>

/* Navigation Bar */
// Welcome function
function welcome() {
 $('#header').append("<span class='welcome mx-auto my-auto' style='font-size: 40px; color: white;'><?php echo $_SESSION['name']; ?></span>");
 }

// Assistant for direction_change function
var direction = 0;
function direction_adjusment(change_to) { direction = change_to; }

// Rotation && toggle Navigation Bar functions
function rotate() {
 $('.welcome').remove();

 $(this).css("transform", "rotate(90deg)");
 $(this).css("transition-duration", "1s");

 $('#navBtns').slideToggle("slow");  //animate({width: 'toggle'});
 }
function rotate_back() {
 $(this).css("transform", "rotate(0deg)");
 $(this).css("transition-duration", "1s");

 $('#navBtns').slideToggle("slow");  //animate({width: 'toggle'});

 setTimeout(function() { welcome(); }, 600);
 }

// Which Rotation function should Run && toggle Navigation Bar
function direction_change() {
 $('#header_circle').off();

 if(direction == 0) {
	$('#header_circle').click(rotate);
	$('#header_circle').on("click", function() {
	 direction_adjusment(1); direction_change(); });
  }
 else {
	$('#header_circle').click(rotate_back);
	$('#header_circle').on("click", function() {
	 direction_adjusment(0); direction_change(); });
  }
 }

// Spark
$('#navBtns').hide();
welcome();

direction_change();


</script>


<!-- >>>>>>>>>> -->
<!-- <<<<<<<<<< -->
