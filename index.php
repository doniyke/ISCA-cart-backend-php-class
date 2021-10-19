<?php
	require_once 'server/fetch_data.php';
	$fetchData = new fetchData;
	$allProducts = $fetchData->fetchAllData('products');
	$ip_address = $_SERVER['REMOTE_ADDR']; 
	$cartItems = $fetchData->fetchUserCart($ip_address)


?>
<!DOCTYPE html>
<html>
<head>
	<title>Test Cart</title>
	<style type="text/css">
		.d-flex{
			display: flex;
			justify-content: space-between;
		}
		.product-div{
			border: 1px solid green;
			margin-bottom: 10px;
		}
		.item-div{
			border: 1px solid firebrick;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<div class="d-flex">
		<div>
			<h1>Products</h1>
			<?php
				if (is_array($allProducts)) {
					foreach ($allProducts as $product) {
						$product_id = $product['id'];
						$product_name = $product['product_name'];
						$product_price = $product['product_price'];
				
			?>
			<div class="product-div">
				<h4><?php echo $product_name ?></h4>
				<h5>#<?= $product_price ?></h5>
				<button onclick='addToCart(<?= $product_id ?>,"<?php echo $product_name ?>", <?= $product_price ?>)'>Add To Cart</button>
			</div>
			<?php
					}
				}else{
					echo '<div>No Product Added Yet</div>';
				}

			?>
		</div>
		<div>
			<h1>Cart Items</h1>
			
			<?php

				if (is_array($cartItems)) {
					foreach ($cartItems as $item) {
						$product_id = $item['id'];
						$product_name = $item['product_name'];
						$product_price = $item['product_price'];
						$quantity = $item['quantity'];
			
			
			?>
			<div class="item-div">
				<h4><?php echo $product_name ?></h4>
				<h5>Quantity - <?php echo $quantity ?></h5>
				<h5>Total = #<?php echo number_format(($quantity * $product_price), 2)  ?></h5>
			</div>
			<?php
					}
				}else{
					echo '<div>No Item Added To Cart Yet</div>';
				}

			?>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>
</body>
</html>