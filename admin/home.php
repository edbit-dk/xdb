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
<br>
    <h3>BRUGERE:</h3>
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" id="users" onchange = "reloadUsers('users');">
        <option>VÆLG TEAM</option>
        <option value="0">ALLE</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
    <br><br>
    <h3>KARAKTERBLADE:</h3>
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" id="records" onchange = "reloadRecords('records');">
        <option>VÆLG TEAM</option>
        <option value="0">ALLE</option>    
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
   <br><br>
    <h3>NY BRUGER:</h3>
    <form action="?page=users" method="POST">
    <label>Navn: <input type="text" name="fullname"></label>
    <label>Brugernavn: <input type="text" name="username"></label>
    <label>Adgangskode: <input type="text" name="password"></label>
    <label>Team: 
    <select name="team_id" >
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    <label> Admin: 
    <select name="admin" >
        <option value="0">Nej</option>
        <option value="1">Ja</option></select> 
    </select> 
    </label>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <input class="btn btn-success" name="create" type="submit" value="Opret">
    </form>
</main>

<script>
var team = 1

function reloadUsers(selectID){
     team = document.getElementById(selectID).value;
     location.href = '?page=users&team_id=' + team;

     if(team != 0) {
        location.href = '?page=users&team_id=' + team;
     } else {
        location.href = '?page=users';
     }
}

function reloadRecords(selectID){
     team = document.getElementById(selectID).value;
     location.href = '?page=records&team_id=' + team;

     if(team != 0) {
        location.href = '?page=records&team_id=' + team;
     } else {
        location.href = '?page=records';
     }
}
</script>