<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Php</title>
	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		.container {
			width: 80%;
			margin: 20px auto;
			padding: 1em;
			background-color: #333;
			color: whitesmoke;
		}
		table, th, td {
			border: 1px solid gray;
			border-collapse: collapse;
		}
		th, td {
			padding: 8px;
		}
		table {
			width: 100%;
			background-color: #141414;
		}
	</style>
</head>
<body>
	<div class="container">
	<table>
	<tr>
	<th>Ime</th>
	<th>Opis</th>
	<th>Cena</th>
	</tr>
	<?php
		$db = new mysqli('localhost', 'root', '', 'trgovina');
		$db->query("SET NAMES utf8");
		$sql = "SELECT * FROM artikli";
		$artikli = $db->query($sql);

		while($a = $artikli->fetch_assoc()){
			echo "<tr>";
			echo "<td>$a[ime]</td>";
			echo "<td>$a[opis]</td>";
			echo "<td>$a[cena] €</td>";
			echo "</tr>";
		}

		$artikli->free();
		$db->close();
	?>
	</table>
	</div>
</body>
</html>