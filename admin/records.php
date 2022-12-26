<?php 

require_once("../bootstrap.php");

require 'header.php';

if(post('csrf')) {
    
    $status = Record::update([
         'team_id' => post('team'),
         'fullname' => post('fullname'),
         'password' => post('password')
     ], 
     [
         'id', '=', post('user_id')
     ]);
 
     message('Oplysninger opdateret!', 'info');
 }

$team_id = '';
$user_id = '';
$admins = User::admins();
$teams = Team::list();
$subjects = Subject::list();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $records = Record::user($user_id);

} elseif(isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $records = Record::teams($team_id);

}else {
    $records = Record::list();
}


?>
<div class="container" style="margin-top: 90px"> 
<?php check_message(); ?>
<caption><h3 align="left">KARAKTERBLADE</h3></caption>
<form align="left">
    <select style="color: #015ab3; font-size: 30px; font-weight: 600;" name="team_id" id="teams" onchange = "reloadTeams('teams');">
        <option value="0">ALLE</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>" <?php if($team->id == $team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
</form>
<p align="left"><a href="?page=home">Gå tilbage</a></p>
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Fag</th>
            <th>Bruger</th>
            <th>Admin</th>
            <th>Klasse</th>
            <th>Forløb</th> 
            <th>1. Standpunkt (vinter)</th>
            <th>2. Standpunkt (sommer)</th>
            <th>Gennemsnit</th>
            <th>Feedback</th>
            <th>Handlinger</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($records)): ?>
        <?php foreach($records as $record): ?>
        <tr>
        <form action="?page=records" method="POST">
            <td><select name="subject_id" >
                <?php foreach($subjects as $subject): ?>
                <option value="<?php echo $subject->id; ?>" <?php if($subject->id == $record->subject_id): ?> selected <?php endif ?>><?php echo $subject->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <td><a class="btn btn-info" href="?page=users&user_id=<?php echo $record->user_id; ?>"><?php echo $record->user_id; ?></a></td>
            <td><a class="btn btn-info" href="?page=users&user_id=<?php echo $record->admin_id; ?>"><?php echo $record->admin_id; ?></a></td>
            <td><select name="team_id" >
                <?php foreach($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if($team->id == $record->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <td><input type="text" name="course_grade" value="<?php echo $record->course_grade; ?>"></td>
            <td><input type="text" name="winter_grade" value="<?php echo $record->winter_grade; ?>"></td>
            <td><input type="text" name="summer_grade" value="<?php echo $record->summer_grade; ?>"></td>
            <td><input type="text" name="final_grade" value="<?php echo $record->final_grade; ?>"></td>
            <td><textarea name="feedback"><?php echo $record->feedback; ?></textarea></td>
            <td>
                <input class="btn btn-secondary" name="update" type="submit" value="Gem">
                <input class="btn btn-danger" onclick="return confirm('Er du sikker?');" name="delete" type="submit" value="Slet">
            </td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
<?php if(!empty($user_id)): ?>
<p>Nyt KARAKTERBLAD:</p>
    <form action="?page=users" method="POST">
    <label>Fag: 
    <select name="subject_id" >
        <option>Vælg Fag</option>
        <?php foreach($subjects as $subject): ?>
        <option value="<?php echo $subject->id; ?>"><?php echo $subject->name; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    <?php var_dump($records); ?>
    <label>Bruger: <input type="text" name="user" value="<?php echo $records; ?>"></label>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <label>Team: 
    <select name="team_id" >
        <option>Vælg Team</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    <label>Admin: 
    <select name="subject_id" >
        <option>Vælg Admin</option>
        <?php foreach($admins as $admin): ?>
        <option value="<?php echo $admin->id; ?>" <?php if($admin->id == session('user')->id): ?>selected<?php endif ?>><?php echo $admin->fullname; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    <label>Forløb: <input name="course_grade" type="number"></label>
    <label>1. standpunkt: <input name="winter_grade" type="number"></label>
    <label>2. standpunkt: <input name="summer_grade" type="number"></label>
    <label>Gennemsnit: <input name="final_grade" type="number"></label>
    <br>
    <label>Feedback: <textarea name="feedback"></textarea>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <br>
    <input class="btn btn-success" name="create" type="submit" value="Opret">
    </form>
<?php endif ?>
</div><!--End of container-->
<script>
var team = 0

function reloadTeams(selectID){
     team = document.getElementById(selectID).value;
     if(team != 0) {
        location.href = '?page=records&team_id=' + team;
     } else {
        location.href = '?page=records';
     }

}
</script>