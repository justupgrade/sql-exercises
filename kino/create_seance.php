<?php
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cinema_id = $_POST['cinema'];
		$movie_id = $_POST['movie'];

		$query = "INSERT INTO seances (cinema_id,movie_id) VALUES(";
		$query .= $cinema_id . ",";
		$query .= $movie_id . ")";

		$result = $conn->query($query);

		if(!$result) die("Error: " . $conn->error);

		echo "Success!";
	}
?>