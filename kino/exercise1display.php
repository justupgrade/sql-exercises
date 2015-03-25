<?php
	include './../db/login.php';
	$conn = new mysqli(HOST, USER, PASS, 'kino');

	//UPDATED!!! NO longer valid for exercise 1 -> displays result of exercise 4!!!

	//DISPLAY all tickets:
	//add ID seance, Movie name, Cinema name, Ticket Price: 
	//SEANCE -> CINEMA_ID, MOVIE_ID
	//TICKET -> SEANCE_ID
	//PAYMENT -> TICKET_ID
	$query = 	"SELECT Tickets.id as TicketID, "; 
	$query .= 	"Cinemas.name as CinemaName, ";
	$query .=	"Movies.name as MovieName, ";
	$query .=	"Tickets.price as TicketPrice ";
	$query .=	"FROM Tickets ";
	$query .=	"LEFT JOIN Payments ON Tickets.id=Payments.payment_id ";
	$query .=	"JOIN seances ON Tickets.seance_id=seances.id ";
	$query .=	"JOIN Movies ON seances.movie_id=Movies.id ";
	$query .=	"JOIN Cinemas ON seances.cinema_id=Cinemas.id ";
	$query .= 	"ORDER BY TicketID";

	//echo $query;

	$result = $conn->query($query);

	if(!$result) die("Erorr: " . $conn->error);

	$rows = $result->num_rows;

	echo "<table>";
	echo "<tr>";
	echo "<th> TicketID </th>";
	echo "<th> CinemaName </th>";
	echo "<th> MovieName </th>";
	echo "<th> TicketPrice </th>";
	echo "</tr>";

	for($i = 0; $i < $rows; $i++) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_ASSOC);

		echo "<tr>";
		echo "<td>" . $row['TicketID'] . "</td>";
		echo "<td>" . $row['CinemaName'] . "</td>";
		echo "<td>" . $row['MovieName'] . "</td>";
		echo "<td>" . $row['TicketPrice'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";

	$conn->close();
	$conn = null;

?>