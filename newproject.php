<?php
include "header.php";

if (isset($_GET['school'])) {
	if (isset($_POST['submit'])) {
		$query = sprintf("insert into projects (name, school_id, description, goalAmount) values ('%s', %d, '%s', %d)", $_POST['name'], $_GET['school'], $_POST['description'], $_POST['goalAmount']);
		mysqli_query($conn, $query);
		$result = mysqli_affected_rows($conn);
		if ($result) {
            header("Location: dashboard.php");
            exit();
        }
	}
} else {
	header("Location: browse.php");
	exit();
}


?>
<form action="" method="post" enc="multipart/form-data">
	<div style="text-align:center; font-size: 130%">
		
		<div>
			<p style="font-size: 300%; margin:20px">New Project</p>
		</div>
		
		<div class="form-container">
			<div>
				<label for="name">Name</label>
				<input name="name" type="text">
			</div>
			<div>
				<label for="goalAmount">Goal Amount</label>
				<input name="goalAmount" type="number">
			</div>
			<div>
				<label for="description">Description</label>
				<textarea name="description"></textarea>
			</div>
			<div>
				<label for="image">Project Image</label>
				<input type="file" name="image">
			</div>
		</div>

		<div style="margin-top:40px;">
			<input id="submit_button" value="Create Project" type="submit" name="submit">
		</div>
	</div>
</form>

<?php require('footer.php'); ?>