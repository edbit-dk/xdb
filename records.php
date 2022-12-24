<?php 

require_once("includes/bootstrap.php");

studconfirm_logged_in();

$records = Record::student(session('user')->id);

?>
<p>(<?php echo session('user')->username; ?>)</p>
<a href="logout.php">Log ud?</a>
<div class="container" style="margin-top: 90px"> 
<caption><h3 align="left">Karakterblad for: <span style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo session('user')->fullname; ?> (<?php echo session('user')->grade; ?>. klasse)</span></h3></caption>
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Klasse</th>
            <th>Fag</th> 
            <th>1. Standpunkt (vinter)</th>
            <th>2. Standpunkt (sommer)</th>
            <th>Karakter</th>
            <th>Feedback</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($records)): ?>
        <?php foreach($records as $record): ?>
        <?php 
            $final_grade = ($record->winter_grade + $record->summer_grade) / 2;
        ?>
        <tr>
            <td><?php echo $record->school_grade; ?></td>
            <td><?php echo $record->subject; ?></td>
            <td><?php echo $record->winter_grade; ?></td>
            <td><?php echo $record->summer_grade; ?></td>
            <td><span style="color: #015ab3; font-weight: 600;"><?php echo $final_grade; ?></span></td>
            <td><textarea cols="50" disabled><?php echo $record->feedback; ?></textarea></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>

</div><!--End of container-->