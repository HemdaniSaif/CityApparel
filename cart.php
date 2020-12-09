<?php
require_once("allRequires.php");
$total = 0;

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
}



?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php
                if (isset($_SESSION['cart'])) {
                    $product_id = array_column($_SESSION['cart'], 'product_id');

                    $result = $allProductDB->getData();
                    if ($result != null) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($product_id as $id) {
                                if ($row['id'] == $id) {
                                    cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                                    $total = $total + (float)$row['product_price'];
                                }
                            }
                        }
                    } else {
                        echo "<h2>You need to run the getStarted Script</h2>";
                    }
                } else {
                    echo "<h5>Cart is Empty</h5>";
                }

                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $count  = count($_SESSION['cart']);
                            echo "<h6>Price ($count items)</h6>";
                        } else {
                            echo "<h6>Price (0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery Fee</h6>
                        <hr>
                        <h6>Total Amount</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                                echo $total;
                                ?></h6>
                    </div>
                    <form method="post">
                        <input type="submit" name="checkout" value="Checkout" class="btn btn-primary btn-block my-3"/>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['checkout'])) {
    if(isset($_SESSION['fname']) && $total>0)
        echo "<script> document.location.href='checkout.php';</script>";
    else if(!isset($_SESSION['fname'])){
        echo '<script>alert("Please log in first.")</script>';
    }
    else{
        echo '<script>alert("Please add an item to cart first.")</script>'; 
    }
}

require_once('footer.php');
?>