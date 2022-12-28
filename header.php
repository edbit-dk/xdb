<?php

require_once("bootstrap.php");

studconfirm_logged_in();

?>
<h6>BRUGER: <?php echo session('user')->username ?> <a class="btn btn-danger" href="logout.php">Log ud?</a> <form action="" method="POST">
<label>Adgangskode: <input type="text" name="password" value="<?php echo session('user')->password; ?>"></label>
<input type="hidden" name="user_id" value="<?php session('user')->id; ?>">
<input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
<input class="btn btn-primary" name="update" type="submit" value="Gem">
</form></h6>