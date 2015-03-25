<?php
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');
	if($conn->connect_error) die("Error: " . $conn->connect_error);
	else echo "<strong style='color:blue'>Connected!</strong><br>";

	//buy ticket
?>

<?php 
	$query = "SELECT name,id FROM Movies";
	$result = $conn->query($query);

	if(!$result) die("Error: " . $conn->error);
	$rows = $result->num_rows;
?>

<fieldset>
	<legend> buy ticket </legend>
	<form id='buy_ticket' method='post' action='buy_ticket_action.php'> 
	<p><label>Choose movie: </label>
		<select name='movie'>

<?php
	for($i = 0; $i < $rows; $i++) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$name = $row['name'];
		$id = $row['id'];
		echo "<option value='".$id."'>" . $name . "</option>";
	}
?>
		</select>
	</p>
	<p><label>Amount: </label>
		<input type='number' name='amount' min='1' max='10' value='1'>
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
	<input type='submit' value='next'>
	</form>
</fieldset>