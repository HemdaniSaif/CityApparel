<?php
require_once("allRequires.php");
?>


<!-- Two Unequal Columns -->
<div class="row">
    <div class="col-12">
        <div class="container my-3">
            <h3 class="text-center">Shipping Address</h3>
            <form method="POST">
            Full Name:
            <input type="text" name="fname" placeholder="Name" value="<?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?>" class="form-control input-sm" required>
            Email:
            <input type="text" name="email" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" class="form-control input-sm" disabled>
            Address:
            <input type="text" name="address" placeholder="Address" class="form-control input-sm" required>
            City
            <input type="text" id="city" name="city" placeholder="City" class="form-control input-sm" required>
            State:
            <input type="text" id="state" name="state" placeholder="State" class="form-control input-sm" required>
            Zip:
            <input type="text" id="zip" name="zip" placeholder="Zip Code" class="form-control input-sm" required>
        </div>

        <div class="container my-3">
            <h3 class="text-center">Payment</h3>
            Name on Card
            <input type="text" name="nameOnCard" placeholder="Name" value="<?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?>" class="form-control input-sm" required>
            Credit card number
            <input type="text" name="cardnumber" placeholder="1111-2222-3333-4444" class="form-control input-sm" required>
            Expiry Month
            <input type="text" name="expmonth" placeholder="10" class="form-control input-sm" required>
            Expiry Year
            <input type="text" name="expyear" placeholder="2022" class="form-control input-sm" required>
            CVV
            <input type="text" name="cvv" placeholder="CVV" class="form-control input-sm" required>  
        </div>
        <div class="text-center">
            
            <input type="submit" name='sO' value="Submit Order" class="btn btn-primary text-center" >
            </form>
        </div>
    </div>
</div>


<?php

if (isset($_POST['sO'])){
    foreach ($_SESSION['cart'] as $key => $value) {
            unset($_SESSION['cart'][$key]);
    }
    echo "<script> alert('Order placed successfully. Thank you for shopping with City Apparel!');</script>";
    echo "<script> document.location.href='index.php';</script>";
}

include 'footer.php';
?>