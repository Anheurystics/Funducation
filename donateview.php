<?php require('header.php');

// if not logged in, redirect to login page
if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
    $_SESSION['login_redirect'] = "donateview.php?id=".$_GET['id'];
    header("Location: login.php");
    exit();
}

// if not a donor, redirect to project page
if ($_SESSION['role'] != 'donors') {
    header("Location: projectview.php?id=".$_GET['id']);
    exit();
}

// get project and if POST, update collected amount and add donor to list of donors of the project
if (isset($_GET['id'])) {
    $query = "select * from projects where id=" . $_GET['id'];
    $project = mysqli_fetch_assoc(mysqli_query($conn, $query));

    if (isset($_POST['submit'])) {
        $query = "update projects set collectedAmount=(collectedAmount+" . $_POST['amount'] . ") where id=" . $_GET['id'];
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);

        $query = "insert into project_donor (project_id, donor_id, amount) values (" . $_GET['id'] . ", " . $_SESSION['id'] . ", " . $_POST['amount'] . ")";
        mysqli_query($conn, $query);
        $result2 = mysqli_affected_rows($conn);

        if ($result && $result2) {
            header("Location: projectview.php?id=".$_GET['id']);
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<div class="donatecontainer" style="align-items:center">
    <div style="display:flex; flex-direction: row;">
        <p id="donate">Donating to </p>
        <a href="./projectview.php?id=<?php echo $project["id"] ?>" title=""><p id="donate" style="padding-left:10px"><?php echo $project["name"] ?></p></a></div>
    </div>
    <form action="" method="post">
        <div style="display:flex; align-items:center; flex-direction:column; font-size:150%;">
            <div>
                <p style="font-size: 200%; text-align:center; margin-top:0px;">Amount</p>
                <input style="font-size: 200%;" type="number" name="amount" min="1" max="<?php echo $project['goalAmount'] - $project['collectedAmount']; ?>" value="50">
            </div>
            <!--
            <div>
                <p>Mode of Payment</p>
                <input type="radio" value"mode1"/>Bruh<br>
                <input type="radio" value"mode2"/>Suh<br>
            </div>
            -->
            <input id="submit_button" type="submit" name="submit" value="Donate">
        </div>
    </form>
</div>

<?php require('footer.php');?>