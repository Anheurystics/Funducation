<?php require('header.php');

if (isset($_GET['id'])) {
    $query = "select * from projects where id=" . $_GET['id'];
    $project = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $query = "select * from schools where id=" . $project['school_id'];
    $school = mysqli_fetch_assoc(mysqli_query($conn, $query));
} else {
    header("Location: index.php");
    exit();
}
?>
<div class="project-profile">
    <div class="project-description">
        <div class="projnamediv">
            <h1 id="project_name"><?php echo $project["name"] ?></h1>
        </div>
        <div class="principal_row">
            <a href="./schoolview.php?id=<?php echo $school["id"] ?>"><p id="school" style="padding-left: 10px;"><?php echo $school["name"] ?></p></a>
        </div>
        <div class="projnamediv">
            <p style="margin: 0px; font-size: 120%">Project Description:
        </div>

        <div class="projnamediv">
            <p style="margin-top:0px; padding-right:20px font-size: 110%"><?php echo $project["description"] ?></p>
        </div>
    </div>
    <div class="project-profile-right-column">
        <div class="project-picture">
            <img src="b0ss.png" width=100%; height=auto; style="border-radius: 25px;">
        </div>
        <div class="project-donate" style="flex:1">
            <div class="projnamediv">
                <h1 style="margin-top: 0px">Project Goal: <?php echo "₱" . $project["goalAmount"] ?></h1>
            </div>
            <div class="projnamediv">
                <?php if($project['collectedAmount'] == $project['goalAmount']) { ?>
                        <p style="color:#19a627">Accomplished</p>
                <?php } else { ?>
                    <?php $percentage = (($project['collectedAmount'] * 1.0) / $project['goalAmount']) * 100;
                    $percentage = round($percentage, 2)?>
                    <div class="progress-bar"><div class="progress-bar-fill" style="width:<?php echo $percentage . '%';?>"></div></div>
                    <p><?php echo "₱" . ($project['goalAmount'] - $project['collectedAmount']) ?> still needed</p>                    
                    <?php if(empty($_SESSION['logged_in']) || ($_SESSION['logged_in'] == 0 || $_SESSION['role'] == 'donors')) { ?>
                    <a href="<?php echo "donateview.php?id=".$project['id'] ?>"><div id="submit_button" style="margin-top:10px; margin-left:10px;">Donate</div></a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>