<?php include("common.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tennis Player Rankings</title>
</head>

<body>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 15px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 15px;
            font-size: 30px;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 40%;
        }

        button,
        h2 {
            font-size: 20px;
        }
    </style>
    <a href='tennis.php'><img src='https://iconape.com/wp-content/png_logo_vector/association-of-tennis-professionals-atp-logo.png' alt='ATP' width="100" height="100"></a>
    <h2>Tennis Player Rankings</h2>
    <?php
    echo "<table border='1'>
			<tr>
				<th>Rankings</th>
				<th>Name</th>
				<th>Points</th>
				<th>(Player ID)</th>

			</tr>";
	 $count = 0;
    foreach ($rankings as $row) {
        $count = $count + 1;

        echo "<tr>";
echo "<td>$count</td>";
echo "<td>";
echo "<form method='post' action='tennis.php'>";
echo "<input type='hidden' name='search_query' id='search_query' value='" . $row['first_name'] . " " . $row['last_name'] . "'>";
echo "<button type='submit'>{$row['first_name']} {$row['last_name']}</button>";
echo "</form>";
echo "</td>";
echo "<td>{$row['points']}</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$row['id']}</td>";
echo "</tr>";

    }

    echo "</table>";
    ?>

    <h2>Retired Players</h2>
    <?php
    echo "<table border='1'>
			<tr>
				<th>Name</th>
			</tr>";

    foreach ($retired as $player) {
            echo "<tr>";
            echo "<td>{$player['first_name']} {$player['last_name']}</td>";
            echo "</tr>";
        }
    echo "</table>";
    ?>

</body>

</html>
