<?php 

require_once("../includes/bootstrap.php");

require 'header.php';

$school_grade = '';

if(isset($_GET['school_grade'])) {
    $school_grade = $_GET['school_grade'] . '. klasse';
    $users = User::school($school_grade);
} else {
    $users = User::list();
}

?>
<div class="container" style="margin-top: 90px"> 
<caption><h3 align="left">Elever</h3></caption>
<p align="left"><span style="color: #015ab3; font-size: 30px; font-weight: 600;"><?php echo $school_grade ?></span></p>
<p align="left"><a href="?page=home">Gå tilbage</a></p>
<table class="table table-hover table-striped">
	<thead>
		<tr>
            <th>Klasse</th>
            <th>Navn</th>
            <th>Brugernavn</th>
            <th>Adgangskode</th>
            <th>Profil</th>
            <th>Karakterblade</th>
		</tr>	
	</thead>
	<tbody>
        <?php if(!empty($users)): ?>
        <?php foreach($users as $user): ?>
        <tr>
        <form action="students.php" method="POST">
            <td><?php echo $user->grade ?></td>
            <td><?php echo $user->fullname ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->password; ?></td>
            <td><a class="btn btn-secondary" href="?page=edit_student=<?php echo $user->id; ?>">Rediger</a></td>
            <td><a class="btn btn-secondary"  href="?page=edit_record=<?php echo $user->id; ?>">Vis</a></td>
        </form>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>	
</table>

</div><!--End of container-->