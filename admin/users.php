<?php require 'header.php'; ?>
<div class="container" style="margin-top: 90px"> 
<?php check_messages(); ?>
<caption><h3 align="left">BRUGERE (<?php echo $user_count; ?>)</h3></caption>
<div style="color: #015ab3; font-size: 30px; font-weight: 600;" align="left">
    <form action="" method="GET">    
        <select name="team_id" id="teams" required>
            <option value="" selected hidden>KLASSE</option>
            <?php foreach($teams as $team): ?>
            <option value="<?php echo $team->id; ?>" <?php if($team->id == $team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
            <?php endforeach ?>
        </select>
        <select name="admin" id="admins" required>
            <option value="" selected hidden>ADMIN?</option>
            <option value="0" <?php if($admin == '0'): ?> selected <?php endif ?>>Nej</option>
            <option value="1" <?php if($admin == 1): ?> selected <?php endif ?>>Ja</option>
        </select>
        <input type="hidden" name="user_id" value="0">
        <input class="btn btn-lg btn-primary" name="filter" type="submit" value="VIS">
        <a class="btn btn-lg btn-secondary" href="users">Nulstil</a>
    </form>
</div>
<br>
<p style="color: #015ab3; font-size: 20px; font-weight: 600;" align="left"><a href="home">TILBAGE</a></p>
<div class="table-responsive">
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Klasse</th>
            <th>Admin?</th>
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
        <?php 
            $record_count = 0;
            $record_count = Record::user($user->id)->row_count();
        ?>
        <tr style="color: #015ab3; font-size: 20px; font-weight: 600;">
        <form action="?page=users" method="POST">
            <td><select name="team_id" >
                <?php foreach($teams as $team): ?>
                <option value="<?php echo $team->id; ?>" <?php if($team->id == $user->team_id): ?> selected <?php endif ?>><?php echo $team->name; ?></option>
                <?php endforeach ?>
            </select> </td>
            <td><input type="number" min="0" max="1" name="admin" value="<?php echo $user->admin ?>"></td>
            <td><input type="text" name="fullname" value="<?php echo $user->fullname ?>"></td>
            <td><?php echo $user->username; ?></td>
            <td><input type="text" name="password" value="<?php echo $user->password; ?>"></td>
            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
            <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
            <td>
                <input class="btn btn-secondary" name="update" type="submit" value="GEM">
                <a class="btn btn-danger" onclick="return confirm('Er du sikker?');" href="users?delete=<?php echo $user->id; ?>">SLET</a>
            </td>
            <td><a class="btn btn-primary"  href="records?team_id=<?php echo $user->team_id ?>&user_id=<?php echo $user->id; ?>&subject_id=0&filter=SØG">(<?php echo $record_count; ?>) VIS</a></td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
</div>
</div><!--End of container-->