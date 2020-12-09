<?php

require_once ("allRequires.php");

//create instance of Createdb class
$host = "127.0.0.1"; /* ENTER YOUR DB HOST / SERVER NAME HERE */
$username = "testUser"; /* ENTER YOUR DB USERNAME HERE */
$password = "123456789"; /* ENTER YOUR DB PASSWORD HERE */


//Creates a new DB first if one by the name of City-Apparel if one doesn't exist

//Creates a new table named productDB
$allProductDB = new CreateDb("CityApparel", "productDB", $host, $username, $password); 

//Creates a new table named users
$usersDB = new CreateDb("CityApparel", "usersDB", $host, $username, $password);


$products = array(
    array(
        "product_name" => "AE Plaid Brushed Oxford Button Up Shirt",
        "product_price" => 23.97,
        "product_description" => "Shirt",
        "product_image" => "images/products/prod1.png"
    ) ,
    array(
        "product_name" => "AE Plaid Brushed Oxford Button Up Shirt",
        "product_price" => 23.97,
        "product_description" => "Shirt",
        "product_image" => "images/products/prod2.png"
    ) ,
    array(
        "product_name" => "AE Cozy AirFlex+ Slim Jeans",
        "product_price" => 34.96,
        "product_description" => "Jeans",
        "product_image" => "images/products/prod3.png"
    ) ,
    array(
        "product_name" => "AE Super Soft Fleece Graphic Hoodie",
        "product_price" => 24.99,
        "product_description" => "Hoodie",
        "product_image" => "images/products/prod4.png"
    ) ,
    array(
        "product_name" => "DISNEY X AE GRAPHIC T-SHIRT",
        "product_price" => 29.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod5.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE GRAPHIC T-SHIRT",
        "product_price" => 29.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod6.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE GRAPHIC T-SHIRT",
        "product_price" => 29.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod7.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE GRAPHIC T-SHIRT",
        "product_price" => 60.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod8.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE DONALD PJ SET",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod9.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE DONALD PJ SET",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod10.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE PJ SET",
        "product_price" => 60.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod11.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE FLEECE CREW NECK",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod12.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE FLEECE CREW NECK",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod13.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE FLEECE CREW NECK",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod14.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE FLEECE CREW NECK",
        "product_price" => 60.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod15.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X AE GRAPHIC T-SHIRT",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod16.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X SUPER SOFT FLEECE HOODIE",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod17.jpg"
    ) ,
    array(
        "product_name" => "DISNEY X SUPER SOFT FLEECE HOODIE",
        "product_price" => 59.00,
        "product_description" => "T-Shirt",
        "product_image" => "images/products/prod18.jpg"
    )
);


foreach ($products as $product){
    addProduct($product);
}   

function addProduct($product){
    global $allProductDB;

    $pName = $product['product_name'];
    $pPrice = $product['product_price'];
    $pDescription = $product['product_description'];
    $pImage = $product['product_image'];

    // Check connection
    if (!$allProductDB->getConnection()){
        die("Connection failed : " . mysqli_connect_error());
    }

    //In order to avoid making duplicate entries, we first need to make sure the product doesn't exist before we add it.
    $checkDupQuery = "SELECT * FROM productDB WHERE product_name=\"$pName\" AND product_price=$pPrice AND product_image = \"$pImage\" LIMIT 1";
    //$result = mysqli_query($con, $checkDupQuery);
    $result = mysqli_query($allProductDB->getConnection(), $checkDupQuery);

    if ($result != null){
        $num_rows = mysqli_num_rows($result);
        //If it goes into this if statement it would mean that the product doesn't exist.
        if (!$num_rows > 0){
            //Creates a prepare statement
            $stmt = $allProductDB->getConnection()->prepare("INSERT INTO productDB (product_name, product_price, product_description, product_image ) VALUES (?, ?, ?, ?)");
            //Binds The Parameters
            $stmt->bind_param("ssss", $pName, $pPrice, $pDescription, $pImage);
            // set parameters and execute
            $pName = $product['product_name'];
            $pPrice = $product['product_price'];
            $pDescription = $product['product_description'];
            $pImage = $product['product_image'];
            $stmt->execute();
            $stmt->close();
        }

    }
}
