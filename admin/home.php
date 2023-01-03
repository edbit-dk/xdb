<?php
require_once("../bootstrap.php");
$teams = Team::list();
?>

<!-- Custom styles for this template -->
<link href="<?php echo url('/assets/theme/css/signin.css') ?>" rel="stylesheet">

<main class="form-signin w-100 m-auto" style="background-color: white; box-shadow: 11px 30px 154px 2px rgb(0 0 0 / 34%); padding: 50px;">
<?php require 'header.php'; ?>    
<h1 class="h3 mb-3 fw-normal"><span style="color: #015ab3; font-size: 30px; font-weight: 600;">X</span>DB</h1>
<h5>Medarbejder</h5>
<?php check_messages(); ?>
<br>
    <a class="btn btn-lg btn-primary" href="users">BRUGERE</a>
    <br><br>
    <a class="btn btn-lg btn-primary" href="records">KARAKTERBLADE</a>
    <br><br>
    <h3>NY BRUGER:</h3>
    <form action="users" method="POST">
    <input type="text" name="fullname" placeholder="Navn" required>
    <input type="text" name="username" placeholder="Brugernavn" required>
    <input type="text" name="password" placeholder="Adgangskode">
    <textarea name="profile" cols="22"></textarea>
    <br><br>
    <select name="team_id" required>
        <option value="" selected hidden>Team</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select> 
    <select name="admin" required>
        <option value="" selected hidden>Admin?</option>
        <option value="0">Nej</option>
        <option value="1">Ja</option></select> 
    </select> 
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <br><br>
    <input class="btn btn-success" name="create" type="submit" value="OPRET">
    </form>
</main>  