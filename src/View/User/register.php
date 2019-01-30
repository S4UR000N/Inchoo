<!-- Spacing -->
<br /><br /><br /><br />

<!-- Form -->
<div class="d-flex justify-content-center">
 <form class="Sign_Up d-flex flex-column" method="post" action="">
  <h1 class="header bg-dark rounded mx-auto p-3" style="color: white;">Register</h1>
   <?php // Display Validation Errors here
   if(isset($viewData) && !empty($viewData['Error'])) {
    echo '<div class="Error bg-dark text-danger mx-auto border rounded px-3 pt-3 pb-1">';
    foreach($viewData['Error'] as $err) {
     echo "<p>$err</p>";
    }
    echo '</div>';
   }
   ?>

<div class="label">Name</div>
<input class="input" type="text" name="user_name" value="<?php if(isset($viewData) && !empty($viewData['Valid']['user_name'])) { echo trim($viewData['Valid']['user_name']); } ?>"/>

<div class="label">Email</div>
<input class="input" type="email" name="user_email" value="<?php if(isset($viewData) && !empty($viewData['Valid']['user_email'])) { echo trim($viewData['Valid']['user_email']); } ?>"/>

<div class="label">Password</div>
<input class="input" type="password" name="user_password" value=""/>

<div class="label">Confirm Password</div>
<input class="input" type="password" name="user_confirm_password" value=""/>

<button class="btn" type="submit" style="background-color: #eaa81b;">Register</button>
<p class="align-self-center">or <a href="http://inchoo.local/login">Login</a></p>
</form>
</div>

<!-- Style -->
<style>
.Error {
width: 100%;
}
.input { border-radius: 5px; }
