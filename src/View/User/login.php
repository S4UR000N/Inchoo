<!-- Spacing -->
<br /><br /><br /><br />

<!-- Form -->
<div class="d-flex justify-content-center">
 <form class="Sign_Up d-flex flex-column" method="post" action="">
  <h1 class="header bg-dark rounded mx-auto p-3" style="color: white;">Login</h1>
   <?php // Display Validation Errors here
   if(isset($viewData) && !empty($viewData['Error'])) {
    echo '<div class="Error bg-dark text-danger mx-auto border rounded px-3 pt-3 pb-1">';
    foreach($viewData['Error'] as $err) {
     echo "<p>$err</p>";
    }
    echo '</div>';
   }
   ?>

<div class="label">Email</div>
<input class="input" type="email" name="user_email" value="<?php if(isset($viewData) && !empty($viewData['Valid']['user_email'])) { echo trim($viewData['Valid']['user_email']); } ?>"/>

<div class="label">Password</div>
<input class="input" type="password" name="user_password" value=""/>

<button class="btn text-light" type="submit" style="font-size: 20px; background-color: #4da3ff">Login</button>
<p class="align-self-center">or <a href="http://inchoo.local/register">Register</a></p>
</form>
</div>

<!-- Style -->
<style>
.Error {
width: 100%;
}
.input { border-radius: 5px; }
</style>
