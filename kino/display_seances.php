<?php
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	//display all cinemas that have specified move:

	//$movie_id = 0;
	//$cinema_id; //???

	//$query = "SELECT * FROM seances WHERE movie_id=".$movie_id;
	//echo 'Cinema Id: ' . $query;

	$query = "SELECT id,name FROM Movies";
	$result = $conn->query($query);

	if(!$result) die("Error: " . $conn->error);

	$rows = $result->num_rows;
?>

<fieldset>
<form action='' method='post'>
<p>
	<label> Choose Movie: </label>
	<select name='movie_id'>
<?php
	for($i = 0; $i < $rows; $i++) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$id = $row['id'];
		$name = $row['name'];

		echo "<option value=".$id.">" . $name . "</option>";
	}
?>
	</select>
</p>
<input type='submit' value='Find cinemas'>
</form>
</fieldset>

<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['movie_id'])) {
		echo "<strong> You can watch this movie in: </strong><br>";
		$movie_id = $_POST['movie_id'];
		$query = "SELECT Cinemas.name as cinema_name FROM Cinemas JOIN seances ON seances.cinema_id=Cinemas.id WHERE seances.movie_id=".$movie_id;
		$result = $conn->query($query);
		if(!$result) die("Error: " . $conn->error);

		$rows = $result->num_rows;

		if($rows > 0) {
			for($i = 0; $i < $rows; $i++) {
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_ASSOC);

				echo $row['cinema_name'] . "<br>";
			}
		} else {
			echo "No match...";
		}
	}

	$query = "SELECT id,name FROM Cinemas";
	$result = $conn->query($query);

	if(!$result) die("Error: " . $conn->error);

	$rows = $result->num_rows;
?>

<fieldset>
<form action='' method='post'>
<p>
	<label> Choose Cinema: </label>
	<select name='cinema_id'>
<?php
	for($i = 0; $i < $rows; $i++) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$id = $row['id'];
		$name = $row['name'];

		echo "<option value=".$id.">" . $name . "</option>";
	}
?>
	</select>
</p>
<input type='submit' value='Find Movies In Selected Cinema'>
</form>
</fieldset>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cinema_id'])) {
		echo "<strong> Movies, you can watch in this cinema: </strong><br>";
		$cinema_id = $_POST['cinema_id'];
		$query = "SELECT Movies.name as movie_name, seances.id as seance_id FROM Movies";
		$query .= " JOIN seances ON seances.movie_id=Movies.id WHERE seances.cinema_id=".$cinema_id;
		$result = $conn->query($query);
		if(!$result) die("Error: " . $conn->error);

		$rows = $result->num_rows;

		
		if($rows > 0) {
			for($i = 0; $i < $rows; $i++) {
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				echo "<form action='buy_ticket_action.php' method='post'>";


				echo $row['movie_name'];
				echo "<input type='number' min='1' max='10' name='quantity' value='1'>";
				echo "<input type='submit' value='buy ticket!'>";
				echo "<input type='hidden' name='seance_id' value=" . $row['seance_id'] . ">";
				echo "<input type='hidden' name='cinema_id' value=" . $cinema_id . ">";
				echo "<input type='hidden' name='movie_name' value=" . $row['movie_name'] . ">";
				echo "</form>";
			}
		} else {
			echo "No match...";
		}

		
	}
?>


<?php
	$conn->close();
	$conn=null;
?>