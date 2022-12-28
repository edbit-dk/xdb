<?php 

require_once("../bootstrap.php");

require 'header.php';


if(post('csrf') && post('create')) {

    $status = Record::create([
        'subject_id' => post('subject_id'),
        'user_id' => post('user_id'),
        'admin_id' => post('admin_id'),
        'team_id' => post('team_id'),
        'avg_grade' => post('avg_grade'),
        'winter_grade' => post('winter_grade'),
        'summer_grade' => post('summer_grade'),
        'feedback' => post('feedback')
    ]);

    redirect_to('/admin?page=records&team_id=' . post('team_id'));
    message('Karakterblad oprettet!', 'info');
}

if(post('csrf') && post('update')) {

    $status = Record::update([
        'subject_id' => post('subject_id'),
        'admin_id' => post('admin_id'),
        'team_id' => post('team_id'),
        'avg_grade' => post('avg_grade'),
        'winter_grade' => post('winter_grade'),
        'summer_grade' => post('summer_grade'),
        'feedback' => post('feedback')
     ], 
     [
         'user_id', '=', post('user_id')
     ]);
 
     redirect_to('/admin?page=records&team_id=' . post('team_id'));
     message('Karakterblad opdateret!', 'info');
 }

$team_id = '';
$user_id = '';
$admins = User::admins();
$teams = Team::list();
$subjects = Subject::list();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $records = Record::user($user_id);
    $user = User::data($user_id)->first();

} elseif(isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $records = Record::teams($team_id);

}else {
    $records = Record::list();
}

?>
<div class="container" style="margin-top: 90px"> 
<?php check_messages(); ?>
<caption><h3 align="left">KARAKTERBLADE</h3></caption>
<div style="color: #015ab3; font-size: 30px; font-weight: 600;" align="left">
    <select name="team_id" id="teams" onchange = "reloadTeams('teams');">
        <option value="0">ALLE</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>" <?php if($team->id == $team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select>
</div>
<br>
<p style="color: #015ab3; font-size: 20px; font-weight: 600;" align="left"><a href="?page=home">TILBAGE</a></p>

<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Fag</th>
            <th>Bruger</th>
            <th>Admin</th>
            <th>Klasse</th>
            <th>Gennemsnit</th> 
            <th>1. Standpunkt (vinter)</th>
            <th>2. Standpunkt (sommer)</th>
            <th>Feedback</th>
            <th>Handlinger</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($records)): ?>
        <?php foreach($records as $record): ?>
         <tr style="color: #015ab3; font-size: 20px; font-weight: 600;">
        <form action="?page=records" method="POST">
            <td><select name="subject_id" >
                <?php foreach($subjects as $subject): ?>
                <option value="<?php echo $subject->id; ?>" <?php if($subject->id == $record->subject_id): ?> selected <?php endif ?>><?php echo $subject->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <input type="hidden" name="user_id" value="<?php echo $record->user_id; ?>">
            <input type="hidden" name="admin_id" value="<?php echo session('user')->id; ?>">
            <td><a class="btn btn-info" href="?page=users&user_id=<?php echo $record->user_id; ?>"><?php echo $record->user_id; ?></a></td>
            <td><a class="btn btn-info" href="?page=users&user_id=<?php echo $record->admin_id; ?>"><?php echo $record->admin_id; ?></a></td>
            <td><select name="team_id" >
                <?php foreach($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if($team->id == $record->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <td><input type="text" min="-3" max="12" name="avg_grade" value="<?php echo $record->avg_grade; ?>"></td>
            <td><input type="text" min="-3" max="12" name="winter_grade" value="<?php echo $record->winter_grade; ?>"></td>
            <td><input type="text" min="-3" max="12" name="summer_grade" value="<?php echo $record->summer_grade; ?>"></td>
            <td><textarea name="feedback"><?php echo $record->feedback; ?></textarea></td>
            <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
            <td>
                <input class="btn btn-secondary" name="update" type="submit" value="GEM">
                <input class="btn btn-danger" onclick="return confirm('Er du sikker?');" name="delete" type="submit" value="SLET">
            </td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>

<?php if(!empty($user_id)): ?>
<p>Nyt KARAKTERBLAD:</p>
<form action="?page=records" method="POST">
    <div class="form-group">
    <label>Fag: 
    <select name="subject_id" >
        <option>Vælg Fag</option>
        <?php foreach($subjects as $subject): ?>
        <option value="<?php echo $subject->id; ?>"><?php echo $subject->name; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    </div>
    <br>
    <div class="form-group">
    <label>Bruger: <input disabled type="text" name="user_id" value="<?php echo $user->fullname; ?> (<?php echo $user->username; ?>)"></label>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    </div>
    <br>
    <div class="form-group">
    <label>Team: 
    <select name="team_id" >
        <option>Vælg Team</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>" <?php if($team->id == $user->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    </div>
    <br>
    <div class="form-group">
    <label>Admin: 
    <select name="admin_id" disabled>
        <option>Vælg Admin</option>
        <?php foreach($admins as $admin): ?>
        <option value="<?php echo $admin->id; ?>" <?php if($admin->id == session('user')->id): ?>selected<?php endif ?>><?php echo $admin->fullname; ?></option>
        <?php endforeach ?>
    </select> 
    <input type="hidden" name="admin_id" value="<?php echo session('user')->id; ?>">
    </label>
    </div>
    <br>
    <div class="form-group">
    <label>Gennemsnit: <input min="-3" max="12" name="avg_grade" type="number" value="0"></label>
    </div>
    <br>
    <div class="form-group">
    <label>1. standpunkt: <input min="-3" max="12" name="winter_grade" type="number" value="0"></label>
    </div>
    <br>
    <div class="form-group">
    <label>2. standpunkt: <input min="-3" max="12" name="summer_grade" type="number" value="0"></label>
    </div>
    <br>
    <label>Feedback: <textarea name="feedback"></textarea>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <br>
    <input class="btn btn-success" name="create" type="submit" value="Opret">
    </form>
<?php endif ?>
</div><!--End of container-->
<br>
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