<?php
require_once("allRequires.php");

if (isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    echo "<h2 class='text-center my-3'>Welcome " . $_SESSION['fname'] . "!</h2>";
    echo "<form method=\"post\">
    <div class='col text-center'><input type=\"submit\" name=\"logout\" value=\"Log Out\" class=\"btn btn-danger btn-sm\" />
    </div></form>";
} else {
    echo "<h4 class='text-center' >Login / Register </h4>";
    echo "<br>";
    require_once('login.php');
    echo "<br><br>";
    require_once('register.php');
    echo "<br>";
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])) {
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['email']);
    echo "<script> document.location.href='account.php';</script>";
}


?>

<?php
include 'footer.php';
?>
