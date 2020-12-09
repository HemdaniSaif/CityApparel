<?php

session_start();

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<title>City Apparel</title>
	<!-- Linking Stylesheet for our CSS frontend work-->
	<link href="style.css" rel="stylesheet">
	<!-- Importing Poppins Font through Google Fonts-->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fc88ae4920fc91564ccfe89/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<body>
	<div class="container">
		<div class="navbar navbar-light bg-light">
			<div class="logo"><img src="images/logo.png" width="125px"></div>
			<nav>
				<ul>
					<li class="nav-item">
						<a class="navbar-brand" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="navbar-brand" href="products.php">Products</a>
					</li>
					<li class="nav-item">
						<a class="navbar-brand" href="account.php">Account</a>
					</li>
				</ul>
            </nav>
            
        <a class="nav-link" href="cart.php">
                <img height="30px" src="images/cart.png" width="30px">
                <?php

                if (isset($_SESSION['cart'])){
                    $count = count($_SESSION['cart']);
                    echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                }else{
                    echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                }

                ?>
        </a>
	</div>
