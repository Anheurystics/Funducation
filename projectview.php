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

$donate_link = "";
if(!empty($_SESSION['logged_in']) && $_SESSION['role'] == 'donor')
{
    $donate_link = "donateview.php?id=".$project['id'];
}
else
{
    $donate_link = "./login.php";
}
?>
<div style="display:flex; flex-direction: row">
    <div style="flex:3; padding-top:10px">
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

        <div class="projnamediv">
            <p style="margin: 0px; font-size: 120%">Project Goal: <?php echo $project["goalAmount"] ?></p>
        </div>

        <div class="projnamediv">
            <progress value="<?php echo $project['collectedAmount'] ?>" max="<?php echo $project['goalAmount'] ?>"></progress>
            <p><?php echo $project['goalAmount'] - $project['collectedAmount'] ?> still needed</p>
        </div>
        <?php if(empty($_SESSION['logged_in']) || ($_SESSION['logged_in'] == 0 || $_SESSION['role'] == 'donor')) { ?>
        <a href="<?php echo $donate_link ?>"><div id="submit_button" style="margin-top:10px; margin-left:10px;">Donate</div></a>
        <?php } ?>
        <!--Redirect login back to projectview once login is done-->
    </div>
    
    <div style="display:flex; flex: 2; margin: 10px; align-items:center;">
        <img src="b0ss.png" width=100%; height=auto; style="border-radius: 25px;">
    </div>
</div>
    
<?php require('footer.php'); ?>