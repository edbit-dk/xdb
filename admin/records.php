<?php require 'header.php'; ?>
<div class="container" style="margin-top: 90px"> 
<?php check_messages(); ?>
<caption><h3 align="left">KARAKTERBLADE (<?php echo $record_count; ?>)
<?php if($user_count == 1):?>
: "<?php echo $user->first()->fullname; ?> (<?php echo $user->first()->username; ?>)"
<?php endif ?>
</h3></caption>
<div style="color: #015ab3; font-size: 30px; font-weight: 600;" align="left">
    <form action="<?php echo current_url() ?>" method="GET">    
        <select name="team_id" id="teams" required>
            <option value="" selected hidden>KLASSE</option>
            <?php foreach($teams as $team): ?>
            <option value="<?php echo $team->id; ?>" <?php if($team->id == $team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
            <?php endforeach ?>
        </select>
        <select name="subject_id" id="subjects" required>
            <option value="" selected hidden>FAG</option>
            <?php foreach($subjects as $subject): ?>
            <option value="<?php echo $subject->id; ?>" <?php if($subject->id == $subject_id): ?> selected <?php endif ?>><?php echo $subject->name; ?></option>
            <?php endforeach ?>
        </select>
        <input type="hidden" name="user_id" value="<?php if(isset($user_id)) {echo $user_id; } ?>">
        <input type="hidden" name="admin_id" value="<?php echo session('user')->id; ?>">
        <input type="hidden" name="filter" value="ALLE">
        <input class="btn btn-lg btn-primary" name="" type="submit" value="SØG">
        <a class="btn btn-lg btn-secondary" href="records">Nulstil</a>
    </form>
</div>
<br>
<p style="color: #015ab3; font-size: 20px; font-weight: 600;" align="left"><a href="home">TILBAGE</a></p>

<div class="table-responsive">
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Fag</th>
            <th>Bruger</th>
            <th>Admin</th>
            <th>Klasse</th>
            <th>1. standpunkt</th>
            <th>Feedback (vinter)</th>
            <th>2. standpunkt</th>
            <th>Feedback (sommer)</th>
            <th>Handlinger</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($records)): ?>
        <?php foreach($records as $record): ?>
         <tr style="color: #015ab3; font-size: 20px; font-weight: 600;">
        <form action="<?php echo current_url() ?>" method="POST">
            <td><select name="subject_id" >
                <?php foreach($subjects as $subject): ?>
                <option value="<?php echo $subject->id; ?>" <?php if($subject->id == $record->subject_id): ?> selected <?php endif ?>><?php echo $subject->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <input type="hidden" name="record_id" value="<?php echo $record->id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $record->user_id; ?>">
            <input type="hidden" name="admin_id" value="<?php echo session('user')->id; ?>">
            <td><a class="btn btn-info" href="users?user_id=<?php echo $record->user_id; ?>&team_id=<?php echo $record->team_id; ?>&admin=0&filter=BRUGER"><?php echo $record->user_id; ?></a></td>
            <td><a class="btn btn-info" href="users?user_id=<?php echo $record->admin_id; ?>&team_id=<?php echo $record->team_id; ?>&admin=1&filter=BRUGER"><?php echo $record->admin_id; ?></a></td>
            <td><select name="team_id" >
                <?php foreach($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if($team->id == $record->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <td><input type="number" min="-3" max="12" name="winter_grade" value="<?php echo $record->winter_grade; ?>"></td>
            <td><textarea name="winter_feedback"><?php echo $record->winter_feedback; ?></textarea></td>
            <td><input type="number" min="-3" max="12" name="summer_grade" value="<?php echo $record->summer_grade; ?>"></td>
            <td><textarea name="summer_feedback"><?php echo $record->summer_feedback; ?></textarea></td>
            <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
            <td>
                <input class="btn btn-secondary" name="update" type="submit" value="GEM">
                <a class="btn btn-danger" onclick="return confirm('Er du sikker?');" href="records?delete=<?php echo $record->id; ?>">SLET</a>
            </td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
</div>
<?php if($user_count == 1):?>
<p style="color: #015ab3; font-size: 20px; font-weight: 600;">Nyt KARAKTERBLAD:</p>
<form action="<?php echo current_url(); ?>" method="POST">
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
    <label>Bruger: <input disabled type="text" name="user_id" value="<?php echo $user->first()->fullname; ?> (<?php echo $user->first()->username; ?>)"></label>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    </div>
    <br>
    <div class="form-group">
    <label>Team: 
    <select name="team_id" >
        <option>Vælg Team</option>
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id; ?>" <?php if($team->id == $user->first()->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
        <?php endforeach ?>
    </select> 
    </label>
    </div>
    <br>
    <div class="form-group">
    <label>Admin: 
    <select name="admin_id">
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
    <label>1. standpunkt: <input min="-3" max="12" name="winter_grade" type="number" value="0"></label>
    <label>Feedback (vinter): <textarea name="winter_feedback"></textarea></label>
    </div>
    <br>
    <div class="form-group">
    <label>2. standpunkt: <input min="-3" max="12" name="summer_grade" type="number" value="0"></label>
    <label>Feedback (sommer): <textarea name="summer_feedback"></textarea></label>    
    </div>
    <br>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <br>
    <input class="btn btn-success" name="create" type="submit" value="Opret">
    </form>
<?php endif ?>
</div><!--End of container-->
<br>
<script>
var team = 0

/*
function reloadTeams(selectID){
     team = document.getElementById(selectID).value;
     if(team != 0) {
        location.href = '?page=records&team_id=' + team;
     } else {
        location.href = '?page=records';
     }

}
*/
</script>