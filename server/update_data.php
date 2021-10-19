<?php
	require_once 'db_connect.php';
	class updateData extends DbConnect{
		public function updateItem($id, $quantity){
			$sql = "UPDATE cart SET quantity = :quantity WHERE id =:id";
			$query = $this->connection->prepare($sql);
			$exec = $query->execute(array(':id'=>$id, ':quantity'=>$quantity));
			if ($query->errorCode()==0) {
				return array('status'=>1);
			}else{
				return array('status'=>0, 'message'=>$query->errorInfo());
			}
		}
	}
?>