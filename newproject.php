<?php
include "header.php";

// if school id is set
if (isset($_GET['school'])) {
	//If POST, create new project and list of needs for project
	if (isset($_POST['submit'])) {
		// save image to /static/
		$info = pathinfo($_FILES['image']['name']);
		$newname = hash("md5", $info['filename']) . "." . $info['extension'];
		move_uploaded_file($_FILES['image']['tmp_name'], './static/'.$newname);

		$query = sprintf("insert into projects (name, school_id, description, goalAmount, image_path) values ('%s', %d, '%s', %d, '%s')", $_POST['name'], $_GET['school'], $_POST['description'], 0, $newname);
		mysqli_query($conn, $query);
		$insert_id = mysqli_insert_id($conn);
		$need_insert = "insert into project_needs (project_id, need, price) values";
		for($i = 0; $i < $_POST['n']; $i++)
		{
			if(isset($_POST['object'.$i]))
			{
				if($i > 0)
				{
					$need_insert .= ',';
				}
				$need_insert .= sprintf(" (%d, '%s', '%s')", $insert_id, $_POST['object'.$i], $_POST['price'.$i]);
			}
		}

		mysqli_query($conn, $need_insert);

		$goalAmount = mysqli_fetch_assoc(mysqli_query($conn, sprintf("select sum(price) as goalAmount from project_needs where project_id=%d group by project_id", $insert_id)))['goalAmount'];
		$totalAmountQuery = sprintf("update projects set goalAmount=%d where id=%d", $goalAmount, $insert_id);

		mysqli_query($conn, $totalAmountQuery);

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
			<p style="font-size: 300%; margin:20px">New Project</p>
		</div>
		
		<div class="form-container">
			<div>
				<input class="inputthing" name="name" type="text" placeholder="Project Name" autofocus/>
			</div>
			<div>
				<textarea class="inputthing" name="description" placeholder="Description"></textarea>
			</div>
			<div style="flex-direction:column">
				<label for="image" style="margin-bottom:20px">Project Image</label>
				<input type="file" name="image">
			</div>
			<ul id="items" style="list-style:none;">
			</ul>
			<div>
				<input class="inputthing" type="button" onclick="addItem()" value="Add Item" />
			</div>
			<input id="n" type="hidden" name="n">
		</div>

		<div style="margin-top:40px;">
			<input id="submit_button" value="Create Project" type="submit" name="submit">
		</div>
	</div>
</form>

<?php require('footer.php'); ?>

<script>
	var n = 0;
	function addItem() {
		var itemsDiv = document.getElementById('items');
		var newLi = document.createElement('li');
		newLi.className = "item"+n;
		var newName = document.createElement('input');
		newName.setAttribute('type', 'text');
		newName.setAttribute('placeholder', 'Item Name');
		newName.setAttribute('id', 'object'+n)
		newName.setAttribute('class', 'inputthing');
		newName.setAttribute('name', 'object'+n);
		var newPrice = document.createElement('input');
		newPrice.setAttribute('type', 'number');
		newPrice.setAttribute('placeholder', 'Item Price');
		newPrice.setAttribute('id', 'price'+n)
		newPrice.setAttribute('class', 'inputthing');
		newPrice.setAttribute('name', 'price'+n);
		var del = document.createElement('input');
		del.setAttribute('type', 'button');
		del.setAttribute('class', 'inputthing');
		del.setAttribute('value', 'Remove');
		newLi.appendChild(newName);
		newLi.appendChild(newPrice);
		newLi.appendChild(del);
		itemsDiv.appendChild(newLi);
		del.onclick = function() {
			itemsDiv.removeChild(newLi);
		};
		n++;
		
		var ni = document.getElementById("n");
		ni.value = n;
	}
</script>