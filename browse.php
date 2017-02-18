<?php require('header.php');

if (isset($_GET['q'])) {
	$query = "select * from projects where upper(name) like upper('%". $_GET['q'] . "%')";
	$get_projects = mysqli_query($conn, $query);

	$query = "select * from schools where upper(name) like upper('%". $_GET['q'] . "%')";
	$get_schools = mysqli_query($conn, $query);
} else {
	$query = "select * from projects";
	$get_projects = mysqli_query($conn, $query);

	$query = "select * from schools";
	$get_schools = mysqli_query($conn, $query);
}

?>
<form class="browse-search" method="GET" action="./browse.php?q={$_GET['q']}">
	<input type="search" name="q" value="" placeholder="Search...">
	<input type="submit" name="" value="Search">
</form>

<?php if ($get_schools) { ?>
	<div>
		<h1>Schools</h1>
	</div>
	<div class="results">
	<?php while ($school = mysqli_fetch_array($get_schools)) {?>
		<div class="result">
			<div class="result-img">
				<img src="pic.jpg"/>
			</div>
			<div class="result-text">
				<div class="title">
					<h2><a href="./schoolview.php?id=<?php echo $school['id'] ?>"><?php echo $school["name"] ?></a></h2>
				</div>
				<div class="location">
					<p><?php echo $school["location"] ?></p>
				</div>
			</div>
			<div style="flex:1; padding:10px"></div>
		</div>
	<?php } ?>
	</div>
<?php } ?>

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
				<p>Goal: <?php echo $project['goalAmount'] ?></p>
				<?php if($project['collectedAmount'] == $project['goalAmount']) { ?>
					<p>Accomplished</p>
				<?php } else { ?>
					<?php $percentage = (($project['collectedAmount'] * 1.0) / $project['goalAmount']) * 100;
					$percentage = round($percentage, 2)?>
					<div class="progress-bar"><div class="progress-bar-fill" style="width:<?php echo $percentage . '%';?>"></div></div>
					<p><?php echo $project['goalAmount'] - $project['collectedAmount'] ?> still needed</p>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	</div>
<?php } ?>
<?php require('footer.php');?>
