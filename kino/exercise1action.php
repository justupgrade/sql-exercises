<?php
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['amount'])) {
			$amount = $_POST['amount'];
			$price = $_POST['price'];
			$payment = $_POST['payment'];

			//insert ticket:
			$query = "INSERT INTO Tickets (quantity,price) VALUES(";
			$query .= $amount . ",";
			$query .= $price . ")";

			$result = $conn->query($query);
			if(!$result) die("Error: " . $conn->error);

			//save payment method:
			$ticket_id = $conn->insert_id;

			$query = "INSERT INTO Payments (type,ticket_id) VALUES(";
			$query .= "'" . $payment . "',";
			$query .= $ticket_id . ")";

			$result = $conn->query($query);
			if(!$result) die("Error: " . $conn->error);

			echo "Success!";
		}
	}
?>