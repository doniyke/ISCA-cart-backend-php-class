<?php
	require_once 'db_connect.php';
	class insertData extends DbConnect{
		public function addNewItem($product_id, $product_price,$product_name, $quantity, $ip_address){
			$sql = "INSERT INTO cart (product_id, product_price,product_name, quantity, ip_address) VALUES (:product_id, :product_price,:product_name, :quantity, :ip_address)";
			$query = $this->connection->prepare($sql);
			$exec = $query->execute(array(':product_id'=>$product_id, ':product_price'=>$product_price,':product_name'=>$product_name, ':quantity'=>$quantity, ':ip_address'=>$ip_address));
			if ($query->errorCode()==0) {
				return array('status'=>1);
			}else{
				return array('status'=>0, 'message'=>$query->errorInfo());
			}
		}
	}
?>
