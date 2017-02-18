<?php require('header.php');

$get_projects = null;
if (isset($_GET['q'])) {
	$query = "select * from projects where upper(name) like upper('%". $_GET['q'] . "%')";
	echo $query;
	$get_projects = mysqli_query($conn, $query);
	echo mysqli_num_rows($get_projects);
	echo $get_projects;
}

?>
		<form method="GET" action="/browse.php?q={$_GET['q']}">
			<input type="search" name="q" value="" placeholder="Search...">
			<input type="submit" name="" value="Search">
		</form>

		<?php if ($get_projects) { ?>
		<div>
			<h1>Projects</h1>
		</div>
		<div class="results">
		<?php while($project = mysql_fetch_array($get_projects)) {?>
			
			<div class="result">
				<div class="result-img">
					<img src="pic.jpg"/>
				</div>
				<div class="result-text">
					<div class="title">
						<h2><a href="#">Mr. Smith's Science Classroom</a></h2>
					</div>
					<div class="description">
						<p>Lorem ipsum dolor sit amet, consectetur 
						adipiscing elit, sed do eiusmod tempor incididunt 
						ut labore et dolore magna aliqua. Ut enim ad minim 
						veniam, quis nostrud exercitation ullamco laboris 
						nisi ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>		
				<div class="donation-stats">
					<div class="progress-bar"></div>
					<p>P200 still needed</p>
				</div>
			</div>
		<?php } ?>
		</div>
<?php require('footer.php');?>
