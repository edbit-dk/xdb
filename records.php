<?php

require 'header.php';

$teams = Team::list();
$subjects = Subject::list();
$records = Record::user(session('user')->id);

if(post('csrf') && post('update')) {
    
    $status = User::update([
         'password' => post('password')
     ], 
     [
         'id', '=', post('user_id')
     ]);

     session('user')->password = post('password');

     message('Oplysninger opdateret!', 'info');

     redirect_to('?page=records');

 }

?>
<div class="container" style="margin-top: 50px"> 
<?php check_messages(); ?>
<caption><h3>KARAKTERBLAD FOR: <span style="color: #015ab3; font-weight: 600;"><?php echo session('user')->fullname; ?> (<?php echo session('user')->username; ?>) - <?php 
foreach($teams as $team) {
    if($team->id == session('user')->team_id) {
        echo $team->name;
    }
}
?></span> </h3></caption>
<br>
<div class="table-responsive">
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Klasse</th>
            <th>Fag</th> 
            <th>Gennemsnit</th>
            <th>1. Standpunkt (vinter)</th>
            <th>2. Standpunkt (sommer)</th>
            <th>Feedback</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($records)): ?>
        <?php foreach($records as $record): ?>
        <tr>
        <td><?php 
        foreach($teams as $team) {
            if($team->id == $record->team_id) {
                echo $team->name;
            }
        }
        ?></td>
        <td><?php 
        foreach($subjects as $subject) {
            if($subject->id == $record->subject_id) {
                echo $subject->name;
            }
        }
        ?></td>
            <td style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $record->avg_grade; ?></td>
            <td style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $record->winter_grade; ?></td>
            <td style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $record->summer_grade; ?></td>
            <td><textarea style="color: #015ab3; font-weight: 600;" cols="50" disabled><?php echo $record->feedback; ?></textarea></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
</div>
<br>

</div><!--End of container-->