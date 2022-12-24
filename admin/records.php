<?php 

require_once("../includes/bootstrap.php");

require 'header.php';
$school_grade = '';

if(isset($_GET['school_grade'])) {
    $school_grade = $_GET['school_grade'] . '. klasse';
    $records = Record::school($school_grade);
} else {
    $records = Record::list();
}

?>
<div class="container" style="margin-top: 90px"> 
<caption><h3 align="left">Karakterblade</h3></caption>
<p align="left"><span style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $school_grade ?></span></p>
<p align="left"><a href="?page=home">Gå tilbage</a></p>
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Elev</th>
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
        <tr>
            <td><?php echo $record->student_id; ?></td>
            <td><?php echo $record->school_grade; ?></td>
            <td><?php echo $record->subject; ?></td>
            <td><?php echo $record->winter_grade; ?></td>
            <td><?php echo $record->summer_grade; ?></td>
            <td><?php echo $record->final_grade; ?></td>
            <td><textarea disabled><?php echo $record->feedback; ?></textarea></td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>

</div><!--End of container-->