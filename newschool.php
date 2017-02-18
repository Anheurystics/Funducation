<?php
include "header.php";

if (isset($_GET['principal'])) {
	if (isset($_POST['submit'])) {
		$query = sprintf("insert into schools (name, location, principal_id) values ('%s', '%s', %d)", $_POST['name'], $_POST['location'], $_GET['principal']);
		mysqli_query($conn, $query);
		$insert_id = mysqli_insert_id($conn);
		mysqli_query($conn, sprintf("update principals set school_id=%d where id=%d", $insert_id, $_SESSION['id']));
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
			<p style="font-size: 300%; margin:20px">Register School</p>
		</div>
		
		<div class="form-container">
			<div>
				<label for="name">Name</label>
				<input class="inputthing" name="name" type="text">
			</div>
			<div>
				<label for="location">Location</label>
				<input class="inputthing" name="location" type="text">
			</div>
			<div>
				<label for="image">School Image</label>
				<input class="inputthing" type="file" name="image">
			</div>
		</div>

		<div style="margin-top:40px;">
			<input id="submit_button" value="Register School" type="submit" name="submit">
		</div>
	</div>
</form>

<?php require('footer.php'); ?>