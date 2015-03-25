<?php 
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$amount = $_POST['amount'];
		$price = $_POST['price'];
		$payment = $_POST['payment'];
		$seance_id = $_POST['seance_id'];

		echo $payment;

		$query = "INSERT INTO Tickets (quantity,price,seance_id) VALUES(";
		$query .= $amount . ",";
		$query .= $price . ",";
		$query .= $seance_id . ")";

		$result = $conn->query($query);
		if(!$result) die("Error: " . $conn->error);

		$ticket_id = $conn->insert_id;

		$query = "INSERT INTO Payments (type,ticket_id) VALUES(";
		$query .= "'" . $payment . "',";
		$query .= $ticket_id . ")";

		$result = $conn->query($query);
		if(!$result) die("Error: " . $conn->error);

		echo "Success!";

	}
?>