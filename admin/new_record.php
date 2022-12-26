<?php 

require_once("../bootstrap.php");

studconfirm_logged_in();

$records = Record::teacher(session('user')->id);

?>
<p>(<?php echo session('user')->username; ?>)</p>
<a href="logout.php">Log ud?</a>
<div class="container" style="margin-top: 90px"> 
<caption><h3 align="left">Karakterblad for: <?php echo session('user')->fullname; ?></h3></caption>
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
        <?php 
            $final_grade = ($record->winter_grade + $record->summer_grade) / 2;

            if($final_grade>=12){
                $remarks = "Fremragende præstation!";	
                $final_grade = 12;
            } elseif($final_grade>10) {
                $remarks = "Fortrinlig præstation!";
                $final_grade = 10;
            } elseif($final_grade>7) {
                $remarks = "God præstation!";
                $final_grade = 7;
            } elseif($final_grade>4) {
                $remarks = "Jævn præstation!";
                $final_grade = 4;
            } elseif($final_grade>2) {
                $remarks = "Tilstrækkelig præstation!";
                $final_grade = 2;
            } elseif($final_grade>0) {
                $remarks = "Utilstrækkelig præstation!";
                $final_grade = 0;
            } elseif($final_grade<0) {
                $remarks = "Ringe præstation!";
                $final_grade = -3;
            }
        ?>;
        <tr>
        <form action="records.php" method="POST">
            <td><?php echo $db->get('users', ['id', '=', $record->student_id])->first()->fullname; ?></td>
            <td><?php echo $record->school_grade; ?></td>
            <td><?php echo $record->subject; ?></td>
            <td><input type="text" name="winter_grade" value="<?php echo $record->winter_grade; ?>"></td>
            <td><input type="text" name="summer_grade" value="<?php echo $record->summer_grade; ?>"></td>
            <td><input type="text" name="final_grade" disabled value="<?php echo $record->final_grade; ?>"></td>
            <td><textarea><?php echo $remarks; ?><?php echo $record->feedback; ?></textarea></td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>

</div><!--End of container-->