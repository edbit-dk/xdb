<?php
confirm_logged_in() 
?>
<p>ADMIN: (<?php echo session('user')->username; ?>) <a class="btn btn-danger" href="logout.php">Log ud?</a></p>