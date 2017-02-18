<?php
    $donations = mysqli_query($conn, sprintf("select project_id, sum(amount) as total_amount from project_donor where donor_id=%d group by project_id;", $_SESSION['id']));
?>
<h1>Donor Dashboard</h1>
<h2>Your Donations</h2>
<?php
if($donations)
{
    while($donation = mysqli_fetch_assoc($donations))
    {
        $project = mysqli_fetch_array(mysqli_query($conn, "select * from projects where id=".$donation["project_id"]));
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
                <div class="description">
                    <p>You have donated a total of <?php echo $donation['total_amount']; ?> to this project</p>
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