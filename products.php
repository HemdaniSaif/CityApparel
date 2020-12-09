<?php
include 'allRequires.php';

if (isset($_POST['add']))
{
    /// print_r($_POST['product_id']);
    if (isset($_SESSION['cart']))
    {

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id))
        {
            echo "<script>alert('Product is in cart!')</script>";
            echo "<script>window.location = 'products.php'</script>";
        }
        else
        {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }
    else
    {

        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}

?>


<div class="container">
	<div class="row text-center py-5">
        <?php
        $result = $allProductDB->getData();
        if ($result != null){
            while ($row = mysqli_fetch_assoc($result)){
                productDisplay($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
            }
        }
        else
            echo "<h2>You need to run the getStarted Script</h2>";
        

        ?>

	</div>
</div>


<?php require_once ("footer.php"); ?>
