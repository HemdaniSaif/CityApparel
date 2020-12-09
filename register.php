<?php
require_once("allRequires.php");


$fname = $lname = $email = $password = $vpassword = $vPasswordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //For First Name Field
    if (!empty($_POST["fname"]))
        $fname = cleanInput($_POST["fname"]);
    //For Last Name Field
    if (!empty($_POST["lname"]))
        $lname = cleanInput($_POST["lname"]);

    //For Email Address
    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        $email = cleanInput($_POST["email"]);

    //For Password
    if (!empty($_POST["password"]))
        $password = $_POST["password"];

    //For Verifying Password
    if (empty($_POST["vpassword"]))
        $vPasswordError = "Verify Password field is required";
    else {
        $vpassword = $_POST["vpassword"];
        if ($password == $vpassword && !empty($password)) {
            $vpassword = $_POST["vpassword"];
            if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($vpassword)) {
                //In order to avoid making duplicate entries, we first need to make sure the product doesn't exist before we add it.
                $checkDupQuery = "SELECT * FROM usersDB WHERE email = \"$email\" LIMIT 1";
                //$result = mysqli_query($con, $checkDupQuery);
                $result = mysqli_query($usersDB->getConnection(), $checkDupQuery);

                if ($result != null) {


                    //Creates a prepare statement
                    $stmt = $usersDB->getConnection()->prepare("INSERT INTO usersDB (fname, lname, email, pword ) VALUES (?, ?, ?, ?)");
                    //Binds The Parameters
                    $stmt->bind_param("ssss", $firstname, $lastname, $emailAddress, $pword);
                    // set parameters and execute
                    $firstname = $fname;
                    $lastname = $lname;
                    $emailAddress = $email;
                    $pword = $password;
                    $stmt->execute();
                    $stmt->close();


                    //Clear Fields:
                    $fnameError = $lnameError = $emailError = $passwordError = $vPasswordError = "";
                    $fname = $lname = $email = $password = $vpassword = "";

                    //Let the user know
                    
                    
                } else {
                    echo '<script>alert("User with these details already exists.")</script>';
                }
            } else if ($password != $vpassword) {
                echo '<script>alert("Passwords do not match.")</script>';
            }
        }
    }
}

?>

<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Register</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control input-sm" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control input-sm" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" value="<?php echo $email; ?>" class="form-control input-sm" placeholder="Email Address" required>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control input-sm" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="vpassword" class="form-control input-sm" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>