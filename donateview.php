<?php require('header.php');
if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
    $_SESSION['login_redirect'] = "donateview.php?id=".$_GET['id'];
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] != 'donors') {
    header("Location: projectview.php?id=".$_GET['id']);
    exit();
}

if (isset($_GET['id'])) {
    $query = "select * from projects where id=" . $_GET['id'];
    $project = mysqli_fetch_assoc(mysqli_query($conn, $query));

    if (isset($_POST['submit'])) {
        $query = "update projects set collectedAmount=(collectedAmount+" . $_POST['amount'] . ") where id=" . $_GET['id'];
        mysqli_query($conn, $query);
        $result=mysqli_affected_rows($conn);
        if ($result) {
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
        <div style="display:flex; align-items:center; flex-direction:column">
            <div>
                <p style="text-align:center">Amount</p>
                <input type="number" name="amount">
            </div>
            <div>
                <p>Mode of Payment</p>
                <input type="radio" value"mode1"/>Bruh<br>
                <input type="radio" value"mode2"/>Suh<br>
            </div>
            <input id="submit_button" type="submit" name="submit" value="Donate">
        </div>
    </form>
</div>

<?php require('footer.php');?>