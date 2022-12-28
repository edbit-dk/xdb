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
    <h3>BRUGERE</h3>
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" id="users" onchange = "reloadUsers('users');">
        <option>VÆLG TEAM</option>
        <option value="0">ALLE</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
    <br><br>
    <h3>KARAKTERBLADE</h3>
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" id="records" onchange = "reloadRecords('records');">
        <option>VÆLG TEAM</option>
        <option value="0">ALLE</option>    
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
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