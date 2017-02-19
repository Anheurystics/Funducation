<?php require('header.php');
// get school, principal, projects if id is set, else redirect to index page
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

if(isset($_POST['submit-file']))
{
    $info = pathinfo($_FILES['file-deposit']['name']);
    move_uploaded_file($_FILES['file-deposit']['tmp_name'], './static/'.$info['basename']);
    mysqli_query($conn, sprintf("insert into files (school_id, pathname) values (%d, '%s')", $_GET['id'], $info['basename']));
}
?>

<div style="display:flex; flex-direction:row; padding:40px" class="schoolcontainer">
    <div style="flex:2" class="school-info">
    

        <div style="padding:20px; border-bottom:2px solid lightgray">
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

        <?php
        // if there are projects, loop through and format
        if ($get_projects) { ?>
        <div style="padding:20px;">
            <h1 style="margin-top:0px;">Projects</h1>
            <div class="results">
            <?php while($project = mysqli_fetch_array($get_projects)) {?>
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
            <?php } ?>
            </div>
        <?php } ?>
        </div>
        
    </div>
    
    <div style="flex:1">
        <div id="schoolheader">
            <img src="./static/<?php echo $school['image_path'] ?>"/>
        </div>

        <?php if((isset($_SESSION['role']) && $_SESSION['role'] != 'principals') || !isset($_SESSION['role'])) { ?>
        <form action="" enctype="multipart/form-data" method="post">
            <div style="margin-left:20px; margin-top:10px; padding: 0px 20px 20px 20px;" class="school-info">
                <h1>Donate Materials</h1>
                <input name="file-deposit" type="file">
                <input type="submit" name="submit-file" value="Deposit File">
            </div>
        </form>
        <?php } else { ?>
        <div style="margin-left:20px; margin-top:10px; padding: 0px 20px 20px 20px;" class="school-info">
            <h1>Deposited Files</h1>
            <?php
            $files = mysqli_query($conn, "select * from files where school_id=".$_GET['id']);
            if($files)
            {
                while($file = mysqli_fetch_assoc($files))
                {
                    $pathname = $file['pathname'];
                    echo "<p><a href='./static/{$pathname}'>{$pathname}</a></p>";
                }
            }
            else
            {
                echo "<p>No deposited files so far!</p>";
            }
            ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>