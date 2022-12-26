<?php 

require_once("../bootstrap.php");

require 'header.php';

if (post('csrf') && post('create')) {

    $password = post('password');

    if(empty($password)) {
        $random_pass = uniqid();
        $password = md5($random_pass);
    }

    User::create([
        'fullname' => post('fullname'),
        'username' => post('username'),
        'password' => $password,
        'team_id' => post('team_id'),
        'admin' => post('admin')
    ]);
    
    message("Bruger opdateret! {$password}", 'info');
}

if(post('csrf') && post('update')) {
    
   $status = User::update([
        'team_id' => post('team_id'),
        'fullname' => post('fullname'),
        'password' => md5(post('password'))
    ], 
    [
        'id', '=', post('user_id')
    ]);

    message('Oplysninger opdateret!', 'info');
}

$team_id  = '';
$user_id = '';
$teams = Team::list();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $users = User::data($user_id)->results();

} elseif(isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $users = User::teams($team_id);

} else {
    $users = User::list();
}



?>
<div class="container" style="margin-top: 90px"> 
<?php check_message(); ?>
<caption><h3 align="left">BRUGERE</h3></caption>
<form align="left">
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" name="team_id" id="teams" onchange = "reloadTeams('teams');">
        <option value="0">Alle</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>" <?php if($team->id == $team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
</form>
<p align="left"><a href="?page=home">Gå tilbage</a></p>

<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Klasse</th>
            <th>Navn</th>
            <th>Brugernavn</th>
            <th>Adgangskode</th>
            <th>Handlinger</th>
            <th>Karakterblade</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($users)): ?>
        <?php foreach($users as $user): ?>
        <tr>
        <form action="?page=users" method="POST">
            <td><select name="team_id" >
                <?php foreach($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if($team->id == $user->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <td><input type="text" name="fullname" value="<?php echo $user->fullname ?>"></td>
            <td><?php echo $user->username; ?></td>
            <td><input type="text" name="password" value="<?php echo $user->password; ?>"></td>
            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
            <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
            <td>
                <input class="btn btn-secondary" name="update" type="submit" value="Gem">
                <input class="btn btn-danger" onclick="return confirm('Er du sikker?');" name="delete" type="submit" value="Slet">
            </td>
            <td><a class="btn btn-primary"  href="?page=records&user_id=<?php echo $user->id; ?>">Vis</a></td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
<p>Ny BRUGER:</p>
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
    <label> Admin: 
    <select name="admin" >
        <option value="0">Nej</option>
        <option value="1">Ja</option></select> 
    </select> 
    </label>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <input class="btn btn-success" name="create" type="submit" value="Opret">
    </form>
</div><!--End of container-->

<script>
var team = 0

function reloadTeams(selectID){
     team = document.getElementById(selectID).value;
     if(team != 0) {
        location.href = '?page=users&team_id=' + team;
     } else {
        location.href = '?page=users';
     }

}
</script>