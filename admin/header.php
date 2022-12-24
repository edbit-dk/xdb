<?php
confirm_logged_in() 
?>
<p>(<?php echo session('user')->username; ?>)</p>
<a href="logout.php">Log ud?</a>