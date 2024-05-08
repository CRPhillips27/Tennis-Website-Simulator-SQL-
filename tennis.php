<?php include ("common.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tennis Player Search</title>
	<style>
		body{
		font-size: 100px;
		}
        .crud-form {
            display: none;
        }
		button{
		font-size: 30px;
		}
		#showCreateForm{
		font-size: 15px;
		}
		#showUpdateForm{
		font-size: 15px;
		}
		#showDeleteForm{
		font-size: 15px;
		}
		label{
		font-size: 15px;
		}
		input{
		font-size: 15px;
		}
		body, h3, p{
		font-size: 15px;
		}
		p{
			font-weight: bold;
		}
		.tables-container {
        display: flex;
        justify-content: space-between; 
    }
	table {
            border-collapse: collapse;
            width: 80%;
            margin: 15px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 20px;
        }

    .table {
        border: 1px solid #ddd; 
    }
	#matchHistoryContainer {
            display: none;
        }
	#playerStatsContainer{
			display: none;
	}
	#personalInfoContainer{
			display: none;
	}
	button,
        h2 {
            font-size: 20px;
        }
    </style>
</head>

<body>
	
		<a href='tennis.php'><img src='https://iconape.com/wp-content/png_logo_vector/association-of-tennis-professionals-atp-logo.png' alt='ATP' width="100" height="100"></a></br></br>
		</br><button onclick="window.location.href='rankings.php'"><h2>Go to Rankings<h2></button></br>
		</br><button onclick="window.location.href='tournaments.php'"><h2>Go to Tournaments<h2></button>
		<form id="H2HForm" class="crud-form" action="h2h.php" method="post">
			<label for="Enter First Player">Enter First Player:</label>
			<input type="text" id="FirstPlayer" name="FirstPlayer" required></br></br>
			versus
			<label for="Enter Second Player">Enter Second Player:</label>
			<input type="text" id="SecondPlayer" name="SecondPlayer" required></br></br>
			<input type="hidden" name="create_player" value="createForm">
			</br><button onclick="window.location.href='h2h.php'"><h2>See Head to Head<h2></button></br></br></br></br>
		</form>
		<form method='post' action='tennis.php'>
        <label for="search_query"><h2>Search for a player(Type Full Name, Go to Rankings for Reference):</h2></label>
        <input type="text" name="search_query" id="search_query">
        <button type="submit">Search</button>
    </form>
</br></br></br></br>

<!--Create Match Form -->

<script>
    function toggleForm(formId) {
        var form = document.getElementById(formId);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
	
    }
	function toggleMatchHistory() {
            var matchHistoryContainer = document.getElementById("matchHistoryContainer");
            if (matchHistoryContainer.style.display === "none") {
                matchHistoryContainer.style.display = "block";
            } else {
                matchHistoryContainer.style.display = "none";
            }
        }
		function togglePlayerStats() {
            var matchHistoryContainer = document.getElementById("playerStatsContainer");
            if (matchHistoryContainer.style.display === "none") {
                matchHistoryContainer.style.display = "block";
            } else {
                matchHistoryContainer.style.display = "none";
            }
        }
		function togglePlayerInfo() {
            var matchHistoryContainer = document.getElementById("personalInfoContainer");
            if (matchHistoryContainer.style.display === "none") {
                matchHistoryContainer.style.display = "block";
            } else {
                matchHistoryContainer.style.display = "none";
            }
        }
</script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($result)) {
        if (!empty($result)) {
            echo "<h1>{$playerInfo['first_name']} {$playerInfo['last_name']}:</h1>";
			if ($playerInfo['ID'] == 1) {
        echo "<img src='data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBUVFRgWFRUYGBgYGBweGhgaGhkaHB4cGRoaGhoaHBocIS4lHB4rIRwaJjgmKy8xNTU1GiU7QDszPy40NTEBDAwMEA8QHhISHzQsJSw1NDQ0NDQ0NDY0NDQxNDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NjQ0NDQ0NP/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAAAwECBAUGBwj/xABBEAACAQIEAwUFBgUCBAcAAAABAgADEQQSITEFQVEGImFxgQcykaGxE0JSwdHwFDNicuGSsmOCs/EVFiMkJUSi/8QAGgEBAAMBAQEAAAAAAAAAAAAAAAECBAMFBv/EACYRAQEAAgEDAwQDAQAAAAAAAAABAhEDEiExBEFRE2FxgSIyQhT/2gAMAwEAAhEDEQA/APZoiICIiAiIgIiICIiAiY+LxSUkapUYIiKSzMbAAbkzyLtV7WnOangkCrewrsczEW1K0/u+BJPLSB63i8dTpC9SoiDqzBdhc7+AnM4v2k8MT/7Ic9ER328QtvnPnXHY+pWa9So9U/idmc6m5ALHTW+3WYofx5cpOh9J0faTwxiR/E5bDdkqKD4AlbEzpcBxGjXXNRqJUU81YH6bT5MzMOZEkweNqUiGpu9Mg3DIxRul7rvGh9dxPC+zntbxFKy4pRiE5utkqAfitbK3lp5z2HgfGqGMpLWoOGQ+hBGhBB1BkDZxEQEREBERAREQEREBERAREQEREBERAREQEjqVAoJJAAFyToABuZJPNfbBx00aKUQwAqkl1BIcquumui33PhaBw3tG7atjHNKmzJh0a2S9vtCGtmYDlpoL2t4zgKjcuXT/ABLq1bN87fv97yNiTbSSlQLeZOGQXGtvE/CVGFNgbfva/lM/DUbXOmbYAAk367aDeNpmNQjCdLjTQnnbw5RUwLABtNuZHpoJl1aZHvEk8yL3vy5baS5H7wyqq82G9um/SRtOmsSgd9hz8T++k2PA+OVcFVFagxVh7yk3R10urDp4/CUeuL2PvA3XS9ueXpYzFxr67AaXFtje1wD0PQxtFj6Y7L8fp47DrXp6X0ZTujAAlT8QfIibqeAey3tI9DEimQCmIZVe+hVtQrjl4T3+FSIiAiIgIiICIiAiIgIiICIiAiIgIiICfPPtpxRbiRW5slFFHrmc/wC75CfQ0+ZfaQ5fimJv91wo8giwNJhcCX2Gk6HhXBUzd+x9JBwQdwjxm8wZsZx5Mr4jZw8eN1a3OH4XSIF0HwHlJ8NwGgCLC1vXTp9JdhXBEyUJEy9V+WrpiSn2coXzFRtpoNOd/EwnZjCjamNdydSd9yfP6TJWuQNTL0r+MnrqvQ5fjXY1DZqRtblvoNvO30nJ8S4GaQ7wvzH6T1OrUvNH2goq1JgRqRofLWXw5bLIpnxY3G33eRq7UnV10ZGDKfFSGH0n1ngK2elTa4OZFa42N1BuLT5Z4tRsw05ctuc+k+xR/wDj8Hz/APbUf+ms2PPsb2IiEEREBERAREQEREBERAREQEREBERApPmTtvTP/ieKH/GPzUGfSuJxCU0L1HVFUXZmICgdSToJ8/8AbSpSq8WZ6LpUSpkOZGV1JCWa5U2uMu0Jk3WJhKeRBm06+HnNtwsow99fAEgTR1uG1MQ5BYoinx+Mhx/C8JTH89s/MAZvWcbjL7tWOWWPidnpOBpoeYHrNiKAO08bweIemdHYC+7K6jlvfb/I6z0vszjC6BTqdNj8NZxz49O2HLcm6TDC8y2wY6TRdoajqBkzA20IuB8eZnDYjieJLZKuLCLzOZvTVZGOEqcsrHpWJw+Xa4mr4nRLo1twLgdes0vDcHWZb08etXTa7a25A57+tpk4PHVUqClXU6kgOdfGxNtR4x0au5SZbmrHD8cpZrkbW9dNZ9GdmaGTB4ZCLZcPSW2/u01E8J4lgc+K/h1F89VUFtwHI5+AJn0PTUKABsAAPTSbJe0YM5rKpIiJKhERAREQEREBERAREQEREBERAREQOC9sGJKYJLbNiEDf2hXf6qs8rThyislVRYlWLAbBsh/Wex+0/CCpw2vf7gVx/wAjAn5XnkGAxBd2/CmZQPGwN/gJzy3K1cWrhr7tg9IsmQc95JR4GPszTstibkkd4kixuRuLaa+EycCgvqZvEqBRtOFys8O8wmTnuKcOVcP9lawzZi51ZjZRu22igAC1gJf2Pw5B1Og2l/GGLbmZPZqkSb8pGWVuPdbHCTJ1OJRSQGF1I9NpzHGeApUU0wg1e+cX5jLY/UTpq2tpcq23lMcrKtcdxzA7J91WViKhcu73IvoBb7NbKNB7wsb38pt1wRyAOQ5TUNpfTntNiB4yOosnLK3vVZOmacng+Fs+OqVw2RaDKwYDUuUFgOthr6iemdk+I1K9EtUBuHZQTYEhbakKLXvfacbwokPVuO67mzf1LTQETuezSgYdbcyx+LGduLK3LX2cOfCY4b13tbiIiaGMiIgIiICIiAiIgIiICIiAiIgIiIGm7W4Q1cFiKai5ai4A8cptPAeCq/2iOLBKgOdbj3gDrbxt859LTyftn2NTDXxVEgJnXNT1updsvd5FbsNDawv5SuU27cWUnatNRYA3m1oksJp6fLymypVLJf8AYEy5RswyafiuLT7UI5yJlJLciRst9rmb7s1x2gVGXQDQgixHS4OuvWaHEqazFFTN+JjsJt+CYJKaEKqM/mBlseRO8XWltW3bdVuLU3rfY5XRrZlJRlVhp7rEWbflNvUW6zWNUqWBZQ1t7EMB6jUTYUKwI0MoVAwt6/KQ1WNt95kVjrNXxCrlU67Am8hYw1a9NCAbFncm2hLXCgdeWs7/AILRyUKanfKCfM6/nOb7P8Ec06X2i5VVFuCbse6NBbYTshNPFjZbaxc/JMpJF0RE7sxERAREQEREBERAREQEREBERAREQKTnu3NDPga4uRZQ2n/DdX5cu7OhkOLoCojo2zqVPkwIhMuq8PpnQTLRAy6nYXt185gVKLUnei579NmQ6WvlNs3kRZvIyehVsbHymbKNuFY9GvUdsuQIB7t7keBIG82a8LxWUOrUWGYfdZRa/u7nlpeUp0D9wgeeo+EyqNfGJ3URWXp3gL/O0r1RoxuolTD4pAGKqvQqzbeqiZuFxrsO9SZH2uLFDtcixjDVMQ38ymFPqfXXSZyWtrz5yuWU9k27ndWo9wOpE0nGbsuQe85CKBuWc5B9bzY4qp42tzmt4M/2vEKCW7qNnJ8lbKD6m/pGGO8nLPLpxtesIoAAGwFh6S+Im15pERAREQEREBERAREQEREBERAREQEREBERA8f9pNIJjc4Gj01L26gsubzsAD5DpObfFW2trseU6n2rIf4lCN/sh8macAynXLp1Tl5rOWU3WnG2YzTreD45W3Og/S97zpExPcDLqCdufnPMcPjSnd5A37w5mbHD8ZKEAXA8fGx/xOeXH37OuPL27vTP4ru730vfwmsxGJUsACT3vSx5zj6naZiCM2t+nLkB4fpIU4g9VgtO+h1Y+6At9T1O+nW0r9O+6fqT2dHxvGhQEQZnY2Cjn/jxmf2TwH2OIohmzOzsXbqSrEAeAFh6TG4NwgrZ2JLdT7x01J6a8pt8E1sVQ8X19VMjG6skWym8bb8V6HERNjziIiAiIgIiICIiAiIgIiICIiAiIgIiIFIlrMALnQCeYca9pjhnGHpoU1FN2JLMRpnCjQJfa51t0j22mS26iH2lur4oKD7tNQ3gSWP0InFvhZmZ2c5nYszasx3JJuSfGZ+GpAjUThll322YY/x01C4UP730+czsH2aR76lfL9JkPhcp02m64WhUgjSUud9l5hPdi4HsXh094M5/qY29F2vNnR4SikBFyBdjYbdLHfzm4p2tfeCCT4StytTJJ4QsqqNNTzJ5+XhMPPlqU3P3aik8tMwB+RmyZABNfjqYZSvhKb1dreZp6NE5Dg3asM9OhWXKzghalxlZlF8pB1ViNRuDqNJ183TvNvOyxuN1VYiJKpERAREQEREBERAREQEREBEpMbG46nRQvVdEUbs7BR8Tz8Ik2MmaLtP2loYKkXqMC1jkpg9525ADkL2ux0E4ztP7TLApg15fznFrf2od/NreRnj/ABLGPWcvUqF2Y6sSSxJ6n8uXKaOP09vfJW5fDoOPdr8Vi1bPVYKxIZEJVMp2XKNxy1veY3BxmS33lY/DlNTgXA7pOp5fvabXCk03DAacxNHLwdfHrE4s+nLdbughGk22CSYuGKuQV2+k2b08pHSeLnuXVenjrzGTWo7G15n4BFtrK4ZA6iS08NaUTWegW295dn8LTGp05OsIWuLyF6cyEW5lMQ6U0Z3YKiC7E8gPz8JGtm9OL7ZBQtOnzJLkeHuj4m/wmHwftdWwTIVu9K9npE6W6ofusPgefUa7i3ETVd67jLm91D91RoieY5+JM0mJqm/1B8bH5aD4z6Lh4JhwTDL9vM5eTqztj6E4F2ow2LH/AKVQZ7a027rD0O48RcTeT5fp4zKQdQRswJuPhqPMTtuAe0TEUgFZlxCjkzd8D+8XP+oGZ+T0l/zf0iZfL2qJyvCu3GErAZnNFjbSpoNf6/d+YnTU6oYXVgwOxBBHxEy5Y5Y+YtLtLERKpIiICIiAiJj4vFJSRnqOqIouzMQAAOpMCeYnEOJUaCF61RaajmzAfC+88q7W+1Cscy4FQqDQ1nU5j/UiH3R4sCfATyzFV3rMXqu7ud3dix+J2HhNGHpsr/bsrcpHsvHfanTAZcIAxGn2jju+aoNW9bes814j2nqYhs1ZnqtfQswAH9qAWX0AmnRBpqZf/Cg85sw4ph4jncrWS+KB+4QfMH6zCr1S2lhbpYfW15VsHbn85aaRHOdLKhCU36+H5TbYHHBhkf3uR5H/ADNdklGpXibngdPg8UUYFeXIztMFi6eITuGz21Q2DadPxDynmFF3A/EPn/mZdKvfU8vr+s48/pcObv4vy7cXPlh28x6vwZbEqZtnozzPhfaKvSIIYVF2yvqfRxqPnOuwfbnCOve+0Rr2ysha56BluAPE2E8vk9Dy4Xxv8NmPqMMvt+WyZrGxmThrNORx/ainbOGVkzAHIHNr66sVANue1rjnL07ZIi5RRqk3tuii/wDqJsPKc8fTcuXibWvLhJ3rrnqogLMwUKLknkBzJnnfaTtF/FNlW64dDcci7jQOf6RyHr0mm4zx6piHK1LBAdEQkKLHQtc3c+J9AJgVQX0Hu8zPT9J6LovVn59p8MnNz9X8cfCyvii7E/dXbxP6CY7Kdzuev73mcKAUfl4+P6THqiehZfdmYriQgEG45TIYSO0pYLWdjrmb/Uf1mXw/ieIoG9Gs9O34WNvgdJABLCJGh6BwH2sYil3cUgrr+NcqOPQd1vlPUuz3ajDY1c1B7sAC1Nu663/EvnpcXHjPmoDrNjw+6WdCysDdXUlWFha4I1G/zmfL02Od7dqtMrH1BE8o7Le0V0Ap4y7qNqqglgP61HvjxUX8DvPUqFZXUMjBlYAhgbgg7EEbiYuTiy47rJ0llSyspKzmlpO0vaCjgaJq1j4IgtmdvwqPqdgJ4px7tLXxzhqxsgN0oqe6vifxv/UfQC5mD2m46+OxDVnuF92mn4E5D+47k9fACYlOelwcEx73y5ZZbZAHhNPicPkewGh1Hl09Jt1bWWYlbgHofrpNWWO1WpF5eM0yzSj7KRoYwBl2WZGQCAsnQgCS5acmCyoWNAiSYIPXqJRZeJaQWkW159V3PmP+8oXX8QB0tfTUagHwO3qZJaVUC8nQip16YGRlqspfMKfcC3Our3JsdRtt0MlXEEj3hmOpI131NvnMWqLuxPIKfqsy2a858ePTvXyW7R0qCKSbXJ3Y/v8ASZAsNpGsEzrOyFtQzFcTJYyFhIqWIYAk7JLAkpoW5Jdkl6rJFSToY6YW5mypUtvLaKaWBMmp7X6jTyl8cdIU+ynbezzj7Uqow7sTTqnuXOiPbQC+yta1hpmt1M46ASLEGxBuCNwRqCPG8ry8U5MLjSXV2+iYnj//AJ/xvSn84nmf8XJ9nT6kecIJkJIFMlXa89DFRKskvf8AfWQK9iL7GTWsZaCNW0BgyqMLDylC46SRQykpmlRAqJeJaBJAIQqJUCJW8sEoJcJTnAgrtZvMAf8A6JmRb1mJiBdwPC49CJl3lcfNSShMqTLTLIWsZGZK5nansDVqYHDVKAVq1S1SoGbKcroCiKdrLpccybzlycmOGur3TJa4OUnZJ7OcZbNVfD0VGpZnJt52AHzmvr8EwNP3+JrUPTD0C4v/AH5ysicuF8Xf43TVc+omRTWS4xcOCow5rm18zVvsxfbLkVNud8x6SlITrj3Qly90+UonX92EltoR4SNzYfL5y6FQ0Eywn6j6XlC31/OQLr+PzlJX4RA019pJSa6N1U/KQ5u6plcG3fZOTqfiBOEvdZfWa6Ajpf4SdqncDTCV+7Y8xdT16iW/a2oL5t9JPUM6l7q36D5w0tp+6t+g+kuU3lpQCS4CVl4EmQUAl4gCVAlkKASsraVECgEqRLlEpUkjGxK2ZW8x8gfyk0ixYJyDq31DCX0tVEpPNSraJUwZZC0ibjAdq8dRpilTxBVFFlGSmxUD7qsyk28725TUGBK5Y45f2m0pMdiqtds1ao9Q/wBbEi/UDYegEiCS9VkgSTJrwhCEk1MS9Ukgpy0gkA0PlMJ6gNhfmD6TNJsJzwrd8npYfARllojZM2o9T+X6yub9+sxEqfGw/U/WTp+n6yJdie4iU0/CIkjS0/cXzMYP+bTiJniVB7if3v8AnMVv5S+bfUREipbJ/cHpJaPKVidJ5Qlpy7/ERLxC5d/SB+cRJFTLukRJFy7+kiqRECWh76/2H/dIV2P9xiJAubeWmIgVlE/KIgTr+X6S8fv4ysRBIu3pKrESyEdfYzlU+9/zfnETlyeYmNlzPrMpN/Uf7YiTilPERLof/9k=' alt='Player 1 Image'><br>";
    }		 elseif ($playerInfo['ID'] == 2) {
        echo "<img src='https://www.atptour.com/-/media/alias/player-headshot/D643' alt='Player 2 Image'><br>";
	}	
	elseif ($playerInfo['ID'] == 3) {
        echo "<img src='https://www.atptour.com/-/media/alias/player-headshot/S0AG' alt='Player 3 Image'><br>";
	}
	elseif ($playerInfo['ID'] == 4) {
        echo "<img src='https://www.atptour.com/-/media/alias/player-headshot/R0DG' alt='Player 4 Image'><br>";
	}
	elseif ($playerInfo['ID'] == 5) {
        echo "<img src='data:image/jpeg;base64,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' alt='Player 5 Image'><br>";
	}
	elseif ($playerInfo['ID'] == 6) {
        echo "<img src='https://www.atptour.com/-/media/alias/player-headshot/RH16' alt='Player 6 Image' > <br>";
	}
	elseif ($playerInfo['ID'] == 7) {
        echo "<img src='https://www.atptour.com/-/media/alias/player-headshot/SU55' alt='Player 7 Image'><br>";
	}
	elseif ($playerInfo['ID'] == 8) {
        echo "<img src='https://www.atptour.com/-/media/alias/player-headshot/N409' alt='Player 8 Image'><br>";
	}
	?><button onclick="togglePlayerInfo()"><h2>PERSONAL INFORMATION</h2></button>
	<div id="personalInfoContainer"><?php
		
	echo "<h2>Name: {$playerInfo['first_name']} {$playerInfo['last_name']}</h2>";
	echo "<h2>Date of Birth: {$playerInfo['date_of_birth']}</h2>";
	echo "<h2>Nationality: {$playerInfo['nationality']}</h2>";
	echo "<h2>Handedness: {$playerInfo['handedness']}</h2>";
	echo "<h2>Points: {$playerInfo['points']}</h2>";
	echo "<h2>Status: {$playerInfo['status']}</h2>";

		?></div></br></br><?php

		$currentTournament = null;
		$wins = 0;
		$losses = 0;
		$counter = 0;
		$setswon = 0;
		$setslost = 0;
		$gameswon = 0;
		$gameslost = 0;
		$titles = [];
		$titleswon = 0;
		$finalsmade = 0;
		$finals = [];
		$roundcount = 0;
		$setcheck = 0; ?>
		<button onclick="toggleMatchHistory()"><h2>MATCH HISTORY:</h2></button>
		<div id="matchHistoryContainer">
		<?php
		foreach ($result as $row) {
		if ($setcheck == 1 and $row['set_number'] == 1){
			echo"</td></tr>";
		}
		if ($row['set_number'] == 1){
			$setcheck = 0;
		}
			if ($setcheck == 0){
			
			if ($row['tourn_name'] != $currentTournament) {
				if ($currentTournament !== null) {
					echo "</table>";
				$roundcount = 0;
				}
				$halftitle = 0;
				$losscheck = 0;
				$currentTournament = $row['tourn_name'];
				echo "<h1>{$currentTournament}</h1>";
				echo "<h2>{$row['location']}</h2>";
				$newDateFormatted = date('Y-m-d', strtotime($row['match_date'] . ' +2 days'));
				echo "<h2>{$row['match_date']} to $newDateFormatted</h2>";
				echo "<table border='1'>
						<tr>
							<th>Round</th>
							<th>Rank</th>
							<th>Opponent</th>
							<th>W-L</th>
							<th>Score</th>
						</tr>";
			}
			if ($row['set_number'] == 1 and $roundcount == 0){
				echo "<td>Semi-Finals</td>";
				$roundcount++;
			}
			elseif ($row['set_number'] == 1 and $roundcount == 1){
				echo "<td>Finals</td>";
				$roundcount++;
			}
			$count = 0;
			foreach ($rankings as $rank) {
				$count = $count + 1;
				$playerID = $rank['id'];
				if ($row['ID'] == $row['player1_id']){
					if($playerID == $row['player2_id'] and $row['set_number'] == 1){
						echo"<td> $count </td>";
				}}
				elseif ($row['ID'] == $row['player2_id']){
					if($playerID == $row['player1_id'] and $row['set_number'] == 1){
						echo"<td> $count </td>";

					}
				}}
			if ($row['set_number'] == 1){
				echo "<td>";
echo "<form method='post' action='tennis.php'>";
echo "<input type='hidden' name='search_query' id='search_query' value='" . $row['opponent_name'] . "'>";
echo "<button type='submit'>{$row['opponent_name']}</button>";
echo "</form>";
echo "</td>";
			}	
			$resultText = "";
			if (isset($row['winner_id']) && $row['winner_id'] == $playerInfo['ID'] && $row['set_number'] == 1) {
				$resultText = "WIN";
				$wins++;
				$halftitle++;
			} elseif ($row['set_number'] == 1) {
				$resultText = "LOSS";
				$losses++;
				$losscheck++;
			}
		
			if ($halftitle == 2){
				$halftitle = 0;
				$titleswon++;
				$titles[] = $currentTournament;
			}
			elseif ($halftitle == 1 && $losscheck > 0){
				$halftitle = 0;
				$finalsmade++;
				$finals[] = $currentTournament;
				
			}
			echo "<td>{$resultText}</td>";
			echo"<td>";
		}
			$setcheck = 1;
		if($setcheck == 1){
			if ($row['ID'] == $row['player1_id']){
			echo "{$row['player1_gameswon']}{$row['player2_gameswon']}   ";
				$gameswon = $row['player1_gameswon'] + $gameswon;
			$gameslost = $row['player2_gameswon'] + $gameslost;	
			if ($row['player1_gameswon'] > $row['player2_gameswon']){
				$setswon++;
			}
			else{
				$setslost++;
			}
			}
			else{
			echo "{$row['player2_gameswon']}{$row['player1_gameswon']}  ";
			$gameswon = $row['player2_gameswon'] + $gameswon;
			$gameslost = $row['player1_gameswon'] + $gameslost;	
			if ($row['player2_gameswon'] > $row['player1_gameswon']){
				$setswon++;
			}
			else{
				$setslost++;
			}
			}
		}
	}
		echo "</table>";  ?> 
		</div></br></br>
		<button onclick="togglePlayerStats()"><h2>PLAYERS STATS:</h2></button>
		<div id="playerStatsContainer">
		<?php
		echo "<h1>Season Record:</h1>";
		echo "<p>Win/Loss Record: $wins - $losses</p>";
		if ($wins > 0 or $losses > 0){
		$winlossrecord = ($wins/($wins + $losses)) * 100;
		$winlosspercentage = round($winlossrecord, 2);
		$setwinrecord = ($setswon/($setswon+$setslost))*100;
		$setwinpercentage = round($setwinrecord, 2);
		$gamewinrecord = ($gameswon/($gameswon+$gameslost))*100;
		$gamewinpercentage = round($gamewinrecord, 2);
		echo "<p>Win/Loss Percentage: $winlosspercentage %</p>";
		echo "<p>Sets Won Percentage: $setwinpercentage %</p>";
		echo "<p>Games Won Percentage: $gamewinpercentage %</p>";
		echo "<h1>Titles & Finals:</h1>";
		echo "<p>Titles: $titleswon</p>";
		foreach ($titles as $value) {
		echo "<p>". $value . "<br>";
		}
		echo "<p>Finals: $finalsmade</p>";
		foreach ($finals as $value) {
		echo "<p>". $value . "<br>";
		}
		echo "<h1>Head to Heads: </h1>";
		$wins = 0;
		$losses = 0;
		$wins = 0;
		$losses = 0;
		$opponentResults = array();
		foreach ($result as $row) {
			if (isset($row['winner_id']) && $row['set_number'] == 1) {
				if ($row['winner_id'] == $playerInfo['ID']) {
					$opponentID = $row['opponent_name'];
            if (!isset($opponentResults[$opponentID])) {
                $opponentResults[$opponentID] = ['wins' => 0, 'losses' => 0];
            }
            $opponentResults[$opponentID]['wins']++;
				} else {
            $opponentID = $row['opponent_name'];
            if (!isset($opponentResults[$opponentID])) {
                $opponentResults[$opponentID] = ['wins' => 0, 'losses' => 0];
            }
            $opponentResults[$opponentID]['losses']++;
        }
    }
}
foreach ($opponentResults as $opponentID => $record) {
    echo "<p>{$record['wins']} - {$record['losses']} $opponentID</p>";
}
	?> </div></br><?php
		}
    } else {
        echo "<p>No results found for the given search query.</p>";
    }
		

	}
?>
</br></br>
<button id="showCreateForm" onclick="toggleForm('createForm')">Add New Player to ATP Tour</button></br></br>
<form id="createForm" class="crud-form" action="CRUD.php" method="post">
    <label for="createFirstName">First Name:</label>
    <input type="text" id="createFirstName" name="first_name" required></br></br>

    <label for="createLastName">Last Name:</label>
    <input type="text" id="createLastName" name="last_name" required></br></br>

    <label for="createDOB">Date of Birth:</label>
    <input type="date" id="createDOB" name="date_of_birth" required></br></br>

    <label for="createNationality">Nationality:</label>
    <input type="text" id="createNationality" name="nationality" required></br></br>

    <label for="createHandedness">Handedness:</label>
    <input type="text" id="createHandedness" name="handedness" required></br></br>
	
	<input type="hidden" name="create_player" value="createForm">
    <input type="submit" value="Create Player"></br></br></br></br>
</form>
<button id="showUpdateForm" onclick="toggleForm('updateForm')">Update Player Information</button></br></br>	
<form id="updateForm" class="crud-form" action="CRUD.php" method="post">
    <label for="updatePlayerID">Player ID(check rankings):</label>
    <input type="text" id="updatePlayerID" name="player_id" required></br></br>

    <label for="updateFirstName">First Name:</label>
    <input type="text" id="updateFirstName" name="first_name" required></br></br>

    <label for="updateLastName">Last Name:</label>
    <input type="text" id="updateLastName" name="last_name" required></br></br>

    <label for="updateDOB">Date of Birth:</label>
    <input type="date" id="updateDOB" name="date_of_birth" required></br></br>

    <label for="updateNationality">Nationality:</label>
    <input type="text" id="updateNationality" name="nationality" required></br></br>

    <label for="updateHandedness">Handedness:</label>
    <input type="text" id="updateHandedness" name="handedness" required></br></br>
	<input type="hidden" name="update_player" value="createForm">
    <input type="submit" value="Update Player"></br></br></br></br>
</form>
<button id="showDeleteForm" onclick="toggleForm('deleteForm')">Retire Player from ATP Tour</button></br></br>	
<!-- Delete Player Form -->
<form id="deleteForm" class="crud-form" action="CRUD.php" method="post">
    <label for="deletePlayerID">Player ID(check rankings):</label>
    <input type="text" id="deletePlayerID" name="player_id" required></br></br>	
	<input type="hidden" name="delete_player" value="createForm">
    <input type="submit" value="Retire Player">
</form>

</body>

</html>
