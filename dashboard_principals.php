<?php    
    $principal = mysqli_fetch_assoc(mysqli_query($conn, sprintf("select * from principals where id=%d;", $_SESSION['id'])));
    $projects = mysqli_query($conn, sprintf("select * from projects where school_id=%d;", $principal['school_id']));
    $school = mysqli_fetch_assoc(mysqli_query($conn, sprintf("select * from schools where id=%d;", $principal['school_id'])));
?>
<h1>Principal Dashboard</h1>
<?php
if($school)
{
    ?>
    <h2>Your Projects for <a href="./schoolview.php?id=<?php echo $school['id'] ?>"><?php echo $school["name"] ?></a></h2>
    <a href="<?php echo "newproject.php?school=".$school['id'] ?>"><div id="submit_button" style="margin-top:10px; margin-left:10px; display: inline-block">New Project</div></a>
    <?php
    if($projects)
    {
        while($project = mysqli_fetch_assoc($projects))
        {
            ?>
            <div class="result">
                <div class="result-img">
                    <img src="./static/<?php echo $project['image_path'] ?>"/>
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
            <?php
        }
    }
}
else
{
    ?>
    <h2>You don't have a school registered yet. <a href="<?php echo "newschool.php?principal=".$_SESSION['id'] ?>">Register yours now</a></h2>
    <?php
}
?>