<?php
	require_once 'fetch_data.php';
	$fetchData = new fetchData;

	require_once 'insert_data.php';
	$insertData = new insertData;

	require_once 'update_data.php';
	$updateData = new updateData;

	$requestingPage = stripslashes($_GET['_page']);

	switch($requestingPage){
		case "addToCart":
			$product_id = $_POST['product_id'];
			$product_name = $_POST['product_name'];
			$product_price = $_POST['product_price'];
			$ip_address = $_SERVER['REMOTE_ADDR']; 

			$checkId = $fetchData->checkProductId($product_id,$ip_address);
			if (is_array($checkId)) {
				if (isset($checkId['status']) && $checkId['status']==1) {
					$currentDataInCart = $checkId['data'];
					foreach ($currentDataInCart as $product ) {
						$quantity = $product['quantity'];
						$id = $product['id'];
					}
					$quantity = $quantity + 1;
					$updateItemQuantity = $updateData->updateItem($id, $quantity);
					if ($updateItemQuantity['status'] && $updateItemQuantity['status']==1) {
						$reponse=array('status'=>1,'message'=>'Item Quantity Has Been Updated');
					}else{
						$reponse=array('status'=>0,'message'=>$updateItemQuantity['message']);
					}
				}else{
					$quantity = 1;
					$addNewCartItem = $insertData->addNewItem($product_id, $product_price,$product_name, $quantity, $ip_address);
					if ($addNewCartItem['status'] && $addNewCartItem['status']==1) {
						$reponse=array('status'=>1,'message'=>'New Item Added');
					}else{
						$reponse=array('status'=>0,'message'=>$addNewCartItem['message']);
					}
				}
			}


			

		break;

		default:
			$reponse=array('status'=>0,'message'=>"Error Adding Item, Please Check Code");
		break;

	}

	echo json_encode($reponse);

?>