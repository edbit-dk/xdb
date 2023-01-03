<?php require 'header.php'; ?>
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
            <th>1. semester</th>
            <th>Feedback (vinter)</th>
            <th>2. semester</th>
            <th>Feedback (sommer)</th>
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
            <td style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $record->winter_grade; ?></td>
            <td><textarea style="color: #015ab3; font-weight: 600;" cols="50" disabled><?php echo $record->winter_feedback; ?></textarea></td>
            <td style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $record->summer_grade; ?></td>
            <td><textarea style="color: #015ab3; font-weight: 600;" cols="50" disabled><?php echo $record->summer_feedback; ?></textarea></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>
</div>
<br>

</div><!--End of container-->