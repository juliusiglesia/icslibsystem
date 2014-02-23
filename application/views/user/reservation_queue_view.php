<?php

/*
*	Filename: reservation_queue_view.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/	

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> ICSLibrarySystem : Reservation </title>
	</head>

	<body>

	<div id="container">
		<table border = "1">
		<?php
			
			foreach($reservations as $row){
				echo "<tr>";
				echo "<td> ${row['materialid']} </td>";
				echo "<td> ${row['idnumber']} </td>";
				echo "<td> ${row['name']} </td>";
				
				if( $row['started'] == 0 ){
					echo "<td> Not yet notified </td>";
				} else {
					echo "<td> ${row['date']} </td>";
				}

				echo "<td> ${row['queue']} </td>";
				echo "</tr>";
			}
			
		?>
		</table>
	</body>
</html>