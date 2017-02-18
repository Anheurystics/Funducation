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
<form action="" method="post">
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
				<label for="description">Description</label>
				<textarea name="description"></textarea>
			</div>
			<ul id="items">
			</ul>
			<div>
				<input type="button" onclick="addItem()" value="Add Item" />
			</div>
		</div>

		<div style="margin-top:40px;">
			<input id="submit_button" value="Create Project" type="submit" name="submit">
		</div>
	</div>
</form>

<?php require('footer.php'); ?>

<script>
	function addItem() {
		var itemsDiv = document.getElementById('items');
		var newLi = document.createElement('li');
		var newName = document.createElement('input');
		newName.setAttribute('type', 'text');
		newName.setAttribute('placeholder', 'Item Name');
		newName.setAttribute('id', ('object'+itemsDiv.childElementCount+1))
		var newPrice = document.createElement('input');
		newPrice.setAttribute('type', 'number');
		newPrice.setAttribute('placeholder', 'Item Price');
		newPrice.setAttribute('id', ('price'+itemsDiv.childElementCount+1))
		newLi.appendChild(newName);
		newLi.appendChild(newPrice);
		itemsDiv.appendChild(newLi);
		console.log();
	}
	function removeItem() {
		
	}
</script>