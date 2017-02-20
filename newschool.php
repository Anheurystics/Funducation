<?php
require("header.php");

// if principal id is set
if (isset($_GET['principal'])) {
	//If POST, create school and redirect to dashboard, else redirect to browse page\
	if (isset($_POST['submit'])) {
		// save image to /uploads/
		$info = pathinfo($_FILES['image']['name']);
		$newname = hash("md5", $info['filename']) . "." . $info['extension'];
		move_uploaded_file($_FILES['image']['tmp_name'], './uploads/'.$newname);
		
		$query = sprintf("insert into schools (name, location, principal_id, image_path) values ('%s', '%s', %d, '%s')", $_POST['name'], $_POST['location'], $_GET['principal'], $newname);
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
<form action="" method="post" enctype="multipart/form-data">
	<div style="text-align:center; font-size: 130%">
		
		<div>
			<p style="font-size: 300%; margin:20px">Register School</p>
		</div>
		
		<div class="form-container">
			<div>
				<input class="inputthing" name="name" type="text" placeholder="Name" autofocus>
			</div>
			<div>
				<input class="inputthing" name="location" type="text" placeholder="Location">
			</div>
			<div style="flex-direction: column">
				<label for="image" style="margin-bottom:20px">School Image</label>
				<input type="file" name="image">
			</div>
		</div>

		<div style="margin-top:40px;">
			<input id="submit_button" value="Register School" type="submit" name="submit">
		</div>
	</div>
</form>

<?php require('footer.php'); ?>