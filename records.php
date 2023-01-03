<?php require 'header.php'; ?>
<div class="container" style="margin-top: 50px"> 
<?php check_messages(); ?>
<caption><h3>KARAKTERBLADE FOR: <span style="color: #015ab3; font-weight: 600;"><?php echo session('user')->fullname; ?> (<?php echo session('user')->username; ?>) - <?php 
foreach($teams as $team) {
    if($team->id == session('user')->team_id) {
        echo $team->name;
    }
}
?></span></h3></caption>
<div style="color: #015ab3; font-size: 30px; font-weight: 600;" align="center">
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
        <input type="hidden" name="filter" value="1">
        <input class="btn btn-lg btn-primary" name="" type="submit" value="SØG">
        <a class="btn btn-lg btn-secondary" href="records">Nulstil</a>
    </form>
</div>
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