<?php
    $principal = mysqli_fetch_assoc(mysqli_query($conn, sprintf("select * from principals where id=%d;", $_SESSION['id'])));
    $projects = mysqli_query($conn, sprintf("select * from projects where school_id=%d;", $principal['school_id']));
    $school = mysqli_fetch_assoc(mysqli_query($conn, sprintf("select * from schools where id=%d;", $principal['school_id'])));
?>
<h1>Your Projects for <?php echo $school["name"] ?></h1>
<?php
if($projects)
{
    while($project = mysqli_fetch_assoc($projects))
    {
        ?>
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
        <?php
    }
}
?>