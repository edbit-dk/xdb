<?php

require_once("../includes/bootstrap.php");

?>

<!-- Custom styles for this template -->
<link href="<?php echo WEB_ROOT; ?>/theme/css/signin.css" rel="stylesheet">

<main class="form-signin w-100 m-auto" style="background-color: white; box-shadow: 11px 30px 154px 2px rgb(0 0 0 / 34%); padding: 50px;">
    <h1 class="h3 mb-3 fw-normal"><span style="color: #015ab3; font-size: 30px; font-weight: 600;">X</span>DB</h1>
    <h5>Medarbejder</h5>
    <a class="w-100 btn btn-lg btn-primary" href="?page=students">Elever</a>
    <a class="btn btn-secondary" href="?page=students&school_grade=7">7. klasse</a>
    <a class="btn btn-secondary" href="?page=students&school_grade=8">8. klasse</a>
    <a class="btn btn-secondary" href="?page=students&school_grade=8">9. klasse</a>
    <br><br>
    <a class="w-100 btn btn-lg btn-primary" href="?page=records">Karakterblade</a>
    <a class="btn btn-secondary" href="?page=records&school_grade=7">7. klasse</a>
    <a class="btn btn-secondary" href="?page=records&school_grade=8">8. klasse</a>
    <a class="btn btn-secondary" href="?page=records&school_grade=8">9. klasse</a>
    <a href="../">Hjem</a>
</main>