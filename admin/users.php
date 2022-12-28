<?php 

require_once("../bootstrap.php");

if (post('csrf') && post('create')) {

    User::create([
        'fullname' => post('fullname'),
        'username' => post('username'),
        'password' => post('password'),
        'team_id' => post('team_id'),
        'admin' => post('admin')
    ]);
    
    redirect_to('/admin?page=users&team_id=' . post('team_id'));
    message("Bruger oprettet!", 'info');
}

if(post('csrf') && post('update')) {
    
   $status = User::update([
        'team_id' => post('team_id'),
        'fullname' => post('fullname'),
        'password' => post('password')
    ], 
    [
        'id', '=', post('user_id')
    ]);

    redirect_to('/admin?page=users&team_id=' . post('team_id'));
    message('Oplysninger opdateret!', 'info');
}

$team_id  = '';
$user_id = '';
$teams = Team::list();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $users = User::data($user_id);

} elseif(isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $users = User::teams($team_id);

} else {
    $users = User::list();
}

require 'header.php';
?>
<div class="container" style="margin-top: 90px"> 
<?php check_messages(); ?>
<caption><h3 align="left">BRUGERE</h3></caption>
<form align="left">
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" name="team_id" id="teams" onchange = "reloadTeams('teams');">
        <option value="0">ALLE</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>" <?php if($team->id == $team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
</form>
<br>
<p style="color: #015ab3; font-size: 20px; font-weight: 600;" align="left"><a href="?page=home">TILBAGE</a></p>

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
        <tr style="color: #015ab3; font-size: 20px; font-weight: 600;">
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
                <input class="btn btn-secondary" name="update" type="submit" value="GEM">
                <input class="btn btn-danger" onclick="return confirm('Er du sikker?');" name="delete" type="submit" value="SLET">
            </td>
            <td><a class="btn btn-primary"  href="?page=records&user_id=<?php echo $user->id; ?>">VIS</a></td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
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