<?php 
//buy senace -> movieID, cinemaID
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	$query = "SELECT name,id FROM Movies";
	$result = $conn->query($query);

	if(!$result) die("Error: " . $conn->error);
	$rows = $result->num_rows;

?>

<fieldset>
<legend> Create Seance </legend>
<form action='create_seance.php' method='post'>
<p><label>Choose Movie:</label>

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

<?php 
	$query = "SELECT name,id FROM Cinemas";
	$result = $conn->query($query);

	if(!$result) die("Error: " . $conn->error);

	$rows = $result->num_rows;
?>

<p>
<label> Choose Cinema: </label>
<select name='cinema'> 
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

<input type='submit' value='+create'>
</form>
</fieldset>