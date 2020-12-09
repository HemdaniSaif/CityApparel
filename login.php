<?php
require_once("allRequires.php");

$email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //For Email Address
    if (!empty($_POST["email"]))
        $email = cleanInput($_POST["email"]);
    //For Password
    if (!empty($_POST["password"]))
        $password = $_POST["password"];

    if (isset($_POST['submit']) && !empty($email) && !empty($password)) {
        $showRecordsQuery = "SELECT fname, lname, email FROM usersDB WHERE email='$email' AND pword='$password'";
        $result = mysqli_query($usersDB->getConnection(), $showRecordsQuery);
        if ($result!=null) {
            foreach($result as $row) {
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['email'] = $row['email'];
            }
            echo "<script> document.location.href='account.php';</script>";
        } else {
            echo "<script> alert(\"User with these details does not exist.\")</script>";
        }
    }
}

?>


<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Login</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">
                        <div class="form-group">
                            <input type="email" name="email" pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" value="<?php echo $email; ?>" class="form-control input-sm" placeholder="Email Address" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control input-sm" placeholder="Password" required="required">
                        </div>

                        <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>