<?php require('header.php');

$get_projects = null;
if (isset($_GET['q'])) {
	$query = "select * from projects where upper(name) like upper('%". $_GET['q'] . "%')";
	$get_projects = mysqli_query($conn, $query);
}

?>
<form method="GET" action="./browse.php?q={$_GET['q']}">
	<input type="search" name="q" value="" placeholder="Search...">
	<input type="submit" name="" value="Search">
</form>

<?php if ($get_projects) { ?>
	<div>
		<h1>Projects</h1>
	</div>
	<div class="results">
	<?php while($project = mysqli_fetch_array($get_projects)) {?>
		<div class="result">
			<div class="result-img">
				<img src="pic.jpg"/>
			</div>
			<div class="result-text">
				<div class="title">
					<h2><a href="./projectview.php?id=<?php echo $project['id'] ?>"><?php echo $project["name"] ?></a></h2>
				</div>
				<div class="description">
					<p><?php echo $project["description"] ?></p>
				</div>
			</div>		
			<div class="donation-stats">
				Goal: <?php echo $project['goalAmount'] ?>
				<progress value="<?php echo $project['collectedAmount'] ?>" max="<?php echo $project['goalAmount'] ?>"></progress>
				<p><?php echo $project['goalAmount'] - $project['collectedAmount'] ?> still needed</p>
			</div>
		</div>
	<?php } ?>
	</div>
<?php } ?>
<?php require('footer.php');?>
