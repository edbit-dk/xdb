<?php

require_once("bootstrap.php");

studconfirm_logged_in();

?>
<p>BRUGER: (<?php echo session('user')->username; ?>)</p>
<a class="btn btn-danger" href="logout.php">Log ud?</a>