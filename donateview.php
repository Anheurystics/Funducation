<?php require('header.php');
if (isset($_GET['id'])) {
    $query = "select * from projects where id=" . $_GET['id'];
    $project = mysqli_fetch_assoc(mysqli_query($conn, $query));
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
    <form>
        <div style="display:flex; align-items:center; flex-direction:column">
            <div>
                <p style="text-align:center">Amount</p>
                <textarea id="amount"></textarea>
            </div>
            <div>
                <p>Mode of Payment</p>
                <input type="radio" value"mode1"/>Bruh<br>
                <input type="radio" value"mode2"/>Suh<br>
            </div>
            <a href="#"><div id="submit_button">Submit</div></a>
            <a href="#"><div id="submit_button">Back</div></a>
        </div>
    </form>
</div>

<?php require('footer.php');?>