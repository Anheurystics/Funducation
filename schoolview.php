<?php require('header.php');

if (isset($_GET['id'])) {
    $query = "select * from schools where id='" . $_GET['id'] . "'";
    $school = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $query = "select * from principals where id='" . $school['principal_id'] . "'";
    $principal = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $query = "select * from projects where school_id='" . $school['id'] . "'";
    $get_projects = mysqli_query($conn, $query);
} else {
    header("Location: index.php");
    exit();
}
?>

<div class="schoolcontainer">
    <div id="schoolheader">
        <img src="b0ss.png" />
    </div>
    <div class="school-info">
        <div>
            <h1 id="school_name"><?php echo $school['name'] ?></h1>
        </div>
        <div class="principal_row">
            <p>Location:</p>
            <p id="location_name" style="padding-left:10px"><?php echo $school['location'] ?></p>
        </div>
        <div class="principal_row">
            <p class="principal_name">Principal:</p>
            <p id="principal_name" style="padding-left:10px"><?php echo $principal['name'] ?></p>
        </div>
    </div>

    <?php if ($get_projects) { ?>
    <div>
        <h1>Projects</h1>
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
                    <p>Goal: <?php echo "₱" . $project['goalAmount'] ?></p>
                    <?php if($project['collectedAmount'] == $project['goalAmount']) { ?>
                            <p>Accomplished</p>
                    <?php } else { ?>
                        <?php $percentage = (($project['collectedAmount'] * 1.0) / $project['goalAmount']) * 100;
                        $percentage = round($percentage, 2)?>
                        <div class="progress-bar"><div class="progress-bar-fill" style="width:<?php echo $percentage . '%';?>"></div></div>
                        <p><?php echo "₱" . ($project['goalAmount'] - $project['collectedAmount']) ?> still needed</p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        </div>
    <?php } ?>
    </div>
</div>

<?php require('footer.php'); ?>