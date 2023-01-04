<div class="container" style="margin-top: 50px">
<h5>BRUGER: <span style="color: #015ab3; font-weight: 600;"><?php echo session('user')->fullname; ?> (<?php echo session('user')->username; ?>) - <?php 
foreach($teams as $team) {
    if($team->id == session('user')->team_id) {
        echo $team->name;
    }
}
?></span> <a class="btn btn-danger" href="logout.php">Log ud?</a></h5> 
<form action="" method="POST">
<label>Adgangskode: <input type="text" name="password" value="<?php echo session('user')->password; ?>"></label>
<input type="hidden" name="user_id" value="<?php echo session('user')->id; ?>">
<input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
<input class="btn btn-primary" name="update" type="submit" value="Gem">
</form>
<br>
<?php if(!empty(session('user')->profile)): ?>
    <h3>ELEVPLAN:</h3>
    <div class="table-responsive">
    <textarea style="color: #015ab3; font-weight: 600;" disabled rows="5" cols="100"><?php echo session('user')->profile ?></textarea> 
    </div>
<?php endif ?>
<br><br>