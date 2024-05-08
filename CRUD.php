<a href='tennis.php'><img src='https://iconape.com/wp-content/png_logo_vector/association-of-tennis-professionals-atp-logo.png' alt='ATP' width="100" height="100"></a>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("common.php");

// Replace these values with your actual database credentials
$user = 'root';
$password = '';
$dsn = "mysql:host=localhost:3306;dbname=tennis";

try {
    $connection = new PDO($dsn, $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Connection failed: " . $ex->getMessage();
}

// Now you can use $connection in the rest of your code


// TO CREATE PLAYER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_player"]) && $_POST["create_player"] === "createForm") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $dob = $_POST["date_of_birth"];
    $nationality = $_POST["nationality"];
    $handedness = $_POST["handedness"];

    try {
        $stmt = $connection->prepare("INSERT INTO players (first_name, last_name, date_of_birth, nationality, handedness, points, status) VALUES (?, ?, ?, ?, ?, 0, 'Active')");
        $stmt->execute([$firstName, $lastName, $dob, $nationality, $handedness]);
        echo "Player added successfully!";
    } catch (PDOException $ex) {
        echo "Error adding player: " . $ex->getMessage();
    }
}


// TO UPDATE PLAYER
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_player'])) {
        $playerId = $_POST['player_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $dob = $_POST['date_of_birth'];
        $nationality = $_POST['nationality'];
        $handedness = $_POST['handedness'];

        try {
		$stmt = $connection->prepare("UPDATE players SET first_name=?, last_name=?, date_of_birth=?, nationality=?, handedness=? WHERE id=? AND status='Active'");
		$stmt->execute([$firstName, $lastName, $dob, $nationality, $handedness, $playerId]);
		$rowCount = $stmt->rowCount();
		if ($rowCount > 0) {
			echo "Player information updated successfully!";
		} else {
			echo "Error: Player is not currently active.";
		}
		} catch (PDOException $ex) {
			echo "Error updating player information: " . $ex->getMessage();
		}
    }
}

//TO DELETE PLAYER
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_player'])) {
        $player = $_POST['player_id'];

        try {
            $stmt = $connection->prepare("UPDATE players SET status = 'Retired', points = 0 WHERE ID = ? AND status = 'Active'");
            $stmt->execute([$player]);

            // Check the player's new status after the update
            $updatedPlayer = $connection->query("SELECT status FROM players WHERE ID = $player")->fetchColumn();

            if ($updatedPlayer == 'Retired') {
                echo "Player retired successfully!";
            } else {
                echo "Error: Player with ID $player is not currently active.";
            }
        } catch (PDOException $ex) {
            echo "Error retiring player: " . $ex->getMessage();
        }
    }
}



if(isset($_POST['create_tournament'])) {
    $tournamentName = $_POST['tourn_name'];
    $location = $_POST['Country'];
    $startDate = $_POST['start_date'];
    $endDate = date('Y-m-d', strtotime($startDate . ' +2 days'));
	
    $result = createTournament($tournamentName, $location, $startDate, $endDate, $connection);
	$query = "INSERT INTO tournaments(tourn_name, location, start_date, end_date) 
						  VALUES('$tournamentName', '$location', '$startDate', '$endDate')";
	$connection->exec($query);
	if ($result == 1){
		echo "Tournament created succcessfully";
	}
}
function createTournament($tournamentName, $location, $startDate, $endDate, $connection) {
	$pdo = new PDO("mysql:host=localhost;dbname=tennis","root","");
	if ($pdo === false) {
    die("Error connecting to the database");
}
	$stmt = $pdo->prepare("SELECT MAX(end_date) AS latest_end_date FROM tournaments");
    $stmt->execute();
	$latestdate = $stmt->fetchAll(PDO::FETCH_COLUMN);
	if ($startDate > $latestdate){
		echo "New Tournament has to come after latest tournament";
		return 0;
	}
    function getRandomPlayerId($excludePlayers) {
	$pdo = new PDO("mysql:host=localhost;dbname=tennis","root","");
	$stmt = $pdo->prepare("SELECT ID FROM players where status = 'Active'");
    $stmt->execute();
	
    $allPlayerIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $availablePlayers = array_diff($allPlayerIds, $excludePlayers);

    if (empty($availablePlayers)) {
        return null; 
    }
    $randomPlayerId = array_rand($availablePlayers);
    return $availablePlayers[$randomPlayerId];
	}

    function getRandomNumberOfSets() {
    return rand(2, 3); 
	}

    function getRandomSetScoreplayer1win() {
        $scores = ['6-0', '6-1', '6-2', '6-3', '6-4', '7-5', '7-6'];
        return $scores[array_rand($scores)];
    }
	function getRandomSetScoreplayer2win() {
        $scores = ['0-6', '1-6', '2-6', '3-6', '4-6', '5-7', '6-7'];
        return $scores[array_rand($scores)];
    }
    function addMatchAndSets($tournamentName, $startDate, $connection) {
        $matchDates = [$startDate, date('Y-m-d', strtotime($startDate . ' +1 day')), date('Y-m-d', strtotime($startDate . ' +2 days'))];
		$player1_id = getRandomPlayerId([]);
        $player2_id = getRandomPlayerId([$player1_id]);
		$player3_id = getRandomPlayerId([$player1_id, $player2_id]);
		$player4_id = getRandomPlayerId([$player1_id, $player2_id, $player3_id]);
		$players = [$player1_id, $player2_id, $player3_id, $player4_id];
        $totalDates = count($matchDates);
		$queryUpdateRankings1 = "UPDATE players p
                        SET points = points + 720
						WHERE last_name IN (
							SELECT last_name FROM players WHERE ID = $players[0]
							OR ID = $players[1]
							OR ID = $players[2]
							OR ID = $players[3]
						)";
		$connection->exec($queryUpdateRankings1);
		for ($i = 0; $i < $totalDates; $i++) {
			$matchDate = $matchDates[$i];
			$sets = getRandomNumberOfSets();
			$setcount = 0;
			//SEMIFINALS
			if ($i < 2) {
				$player1_id = $players[2 * $i];
				$player2_id = $players[(2 * $i) + 1];
				if (rand(0, 1) === 0) {
				$winner_id = $player1_id;
				} else {
				$winner_id = $player2_id;
				}
				$queryUpdateRankings2 = "UPDATE players p
                        SET points = points + 480
                        WHERE last_name IN (
                          SELECT last_name FROM players WHERE ID = $winner_id
                        )";
				$connection->exec($queryUpdateRankings2);
				$query = "INSERT INTO matches(tourn_name, player1_id, player2_id, match_date, winner_id) 
						  VALUES('$tournamentName', $player1_id, $player2_id, '$matchDate', $winner_id)";
				$winnerarray[$i] = $winner_id;
				$connection->exec($query);
				$matchId = $connection->lastInsertId();
			//FINALS
			} else {
				
				$player1_id = $winnerarray[0];
				$player2_id = $winnerarray[1];
				if (rand(0, 1) === 0) {
				$winner_id = $player1_id;
				} else {
				$winner_id = $player2_id;
				}
				$queryUpdateRankings3 = "UPDATE players p
                        SET points = points + 800
                        WHERE last_name IN (
                          SELECT last_name FROM players WHERE ID = $winner_id
                        )";
				$connection->exec($queryUpdateRankings3);
				$query = "INSERT INTO matches(tourn_name, player1_id, player2_id, match_date, winner_id) 
						  VALUES('$tournamentName', $player1_id, $player2_id, '$matchDate', $winner_id)";
				$connection->exec($query);
				$matchId = $connection->lastInsertId();			  
			}
				//SETS
			$setchecker=0;
			for ($j = 1; $j <= $sets; $j++) {
				if ($winner_id == $player1_id){
					//WINNER IS FIRST GUY
					if ($sets == 2){
						$score = getRandomSetScoreplayer1win();
					}elseif ($sets == 3){
						if($j == 1){
							if (rand(0, 1) === 0) {
								$score = getRandomSetScoreplayer1win();
								
							} else {
								$score = getRandomSetScoreplayer2win();
								$setchecker++;
							}
						}
						elseif($j == 2){
							if ($setchecker == 1){
								$score = getRandomSetScoreplayer1win();
							}
							else{
								$score = getRandomSetScoreplayer2win();
							}							
						}
						else{
							$score = getRandomSetScoreplayer1win();
						}
					}					
					//WINNER IS SECOND GUY
				}else{
					if ($sets == 2){
						$score = getRandomSetScoreplayer2win();
					}elseif ($sets == 3){
						if($j == 1){
							if (rand(0, 1) === 0) {
								$score = getRandomSetScoreplayer2win();
								
							} else {
								$score = getRandomSetScoreplayer1win();
								$setchecker++;
							}
						}
						elseif($j == 2){
							if ($setchecker == 1){
								$score = getRandomSetScoreplayer2win();
							}
							else{
								$score = getRandomSetScoreplayer1win();
							}							
						}
						else{
							$score = getRandomSetScoreplayer2win();
						}
					}
				}
				list($player1GamesWon, $player2GamesWon) = explode('-', $score);
				$query = "INSERT INTO sets(match_ID, set_number, player1_gameswon, player2_gameswon) 
						  VALUES($matchId, $j, $player1GamesWon, $player2GamesWon)";	  
				$connection->exec($query);		
									
			}
		}
	
	}
    addMatchAndSets($tournamentName, $startDate, $connection);
	return 1;
}
if(isset($_POST['delete_tournament'])) {
    $tournamentName = $_POST['tourn_name'];
    deleteTournament($tournamentName, $connection);
    echo "Tournament deleted successfully!";
}
function deleteTournament($tournamentName, $connection) {
	$pdo = new PDO("mysql:host=localhost;dbname=tennis","root","");
    $stmt = $pdo->prepare("SELECT ID FROM players where status = 'Active'");
    $stmt->execute();
    $allPlayerIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    // Subtract 720 points from all players in the tournament
    $queryUpdateAllPlayers = "UPDATE players p
                              SET points = points - 720
                                  WHERE ID IN (
                                      SELECT player1_id FROM matches WHERE tourn_name = '$tournamentName'
                                      UNION
                                      SELECT player2_id FROM matches WHERE tourn_name = '$tournamentName'
                                  )
                              ";
    $connection->exec($queryUpdateAllPlayers);

    // Subtract 480 points from the two early winners
    $queryUpdateEarlyWinners = "UPDATE players p
                                SET points = points - 480
                                    WHERE ID IN (
                                        SELECT winner_id FROM matches
                                        WHERE tourn_name = '$tournamentName'
                                        AND match_date != (SELECT MAX(match_date) FROM matches WHERE tourn_name = '$tournamentName')
                                    )";
    $connection->exec($queryUpdateEarlyWinners);

    // Subtract 800 points from the final winner
    $queryUpdateFinalWinner = "UPDATE players p
                               SET points = points - 800
                                   WHERE ID IN (
                                       SELECT winner_id FROM matches
                                       WHERE tourn_name = '$tournamentName'
                                       AND match_date = (SELECT MAX(match_date) FROM matches WHERE tourn_name = '$tournamentName')
                                   )
                               ";
    $connection->exec($queryUpdateFinalWinner);

    // Delete sets related to the tournament
    $queryDeleteSets = "DELETE s FROM sets s
                       JOIN matches m ON s.match_ID = m.ID
                       WHERE m.tourn_name = '$tournamentName'";
    $connection->exec($queryDeleteSets);

    // Delete matches of the tournament
    $queryDeleteMatches = "DELETE FROM matches
                          WHERE tourn_name = '$tournamentName'";
    $connection->exec($queryDeleteMatches);

    // Delete the tournament record
    $queryDeleteTournament = "DELETE FROM tournaments
                              WHERE tourn_name = '$tournamentName'";
    $connection->exec($queryDeleteTournament);
}


// Example usage:
// Assuming $connection is your PDO database connection
// and $tournamentName is the name of the tournament to be deleted

//MATCHES

//RANKINGS
//SETS
//TOURNAMENTS
?>
