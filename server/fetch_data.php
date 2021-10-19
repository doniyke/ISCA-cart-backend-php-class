<?php
	require_once 'db_connect.php';
	class fetchData extends DbConnect{
		public function fetchAllData($tblName){
			$sql = "SELECT * FROM {$tblName} ORDER BY id";
			$query = $this->connection->prepare($sql);
			$exec = $query->execute();
			if ($query->errorCode()==0) {
				if ($query->rowCount() > 0) {
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}
			}else{
				return array('status'=>0, 'message'=>$query->errorInfo());
			}
		}

		public function fetchUserCart($ip_address){
			$sql = "SELECT * FROM cart WHERE ip_address = :ip_address ORDER BY id";
			$query = $this->connection->prepare($sql);
			$exec = $query->execute(array(':ip_address'=>$ip_address));
			if ($query->errorCode()==0) {
				if ($query->rowCount() > 0) {
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return 0;
				}
			}else{
				return array('status'=>0, 'message'=>$query->errorInfo());
			}
		}

		public function checkProductId($product_id, $ip_address){
			$sql = "SELECT * FROM cart WHERE product_id = :product_id AND ip_address = :ip_address";
			$query = $this->connection->prepare($sql);
			$exec = $query->execute(array(':product_id'=>$product_id, ':ip_address'=>$ip_address));
			if ($query->errorCode() == 0) {
				if ($query->rowCount()>0) {
					$data = $query->fetchAll(PDO::FETCH_ASSOC);
					return array('status'=>1, 'data'=>$data);
				}else{
					return array('status'=>0);
				}
			}else{
				return array('status'=>0, 'message'=>$query->errorInfo());
			}
		}

	}
?>