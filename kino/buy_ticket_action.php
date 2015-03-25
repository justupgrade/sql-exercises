<?php
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		//amount... seance_id... price...
		$seance_id = $_POST['seance_id'];
		$amount = $_POST['quantity'];
		$seance_id = $_POST['seance_id'];
		$price = 30;
		$movie_name = $_POST['movie_name'];
		$cinema_id = $_POST['cinema_id'];

		$query = "SELECT name FROM Cinemas WHERE id=".$cinema_id;
		$result = $conn->query($query);
		if(!$result) die("Error: " . $conn->error);

		$rows = $result->num_rows;
		$ciname_name;

		for($i = 0; $i < $rows; $i++) {
			$result->data_seek($i);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$cinema_name = $row['name'];
		}

		echo $cinema_name . ", " . $movie_name;
	}
?>
<fieldset>
	<form action='finalize_transaction.php' method='post'>
	<?php echo "<input type='hidden' name='seance_id' value=".$seance_id. ">"; ?>
	<input type='hidden' name='price' value='30'>
	<p><label>Amount: </label>
		<?php echo "<input type='number' name='amount' min='1' max='10' value=" . $amount . ">"; ?>
	</p>
	<p><label>Price: <strong style='color: orange'>30PLN</strong></label>
	</p>
	<p><label>Choose payment option:</label>
		<select name='payment'>
			<option value='karta'> Karta </option>
			<option value='gotowka'> Gotowka </option>
			<option value='przelew'> Przelew </option>
			<option value='nieoplacony'> Nieoplacony </option>
		</select>
	</p>
	<input type='submit' value='Finalize'>
</form>
</fieldset>