<?php
$user = 'root';
$password = '';
$dsn = "mysql:host=localhost:3306;dbname=tennis";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Connection failed: " . $ex->getMessage();
}

$playerInfo = null; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search_query'])) {    
        try {
            $search_query = $_POST['search_query'];

            $stmt = $pdo->prepare("SELECT players.ID, players.first_name, players.last_name, players.date_of_birth, players.nationality, players.handedness, players.points, players.status,
                                        matches.tourn_name, matches.match_date, matches.player1_id, matches.player2_id, tournaments.location,
                                        sets.set_number, sets.player1_gameswon, sets.player2_gameswon, 
                                        CONCAT(opponents.first_name, ' ', opponents.last_name) AS opponent_name,
                                        matches.winner_id, players.ID
                                 FROM players
                                 LEFT JOIN matches ON players.ID = matches.winner_id OR players.ID = matches.player1_id OR players.ID = matches.player2_id
                                 LEFT JOIN tournaments ON matches.tourn_name = tournaments.tourn_name
                                 LEFT JOIN sets ON matches.ID = sets.match_ID
                                 LEFT JOIN matches AS opponents_match ON sets.match_ID = opponents_match.ID
                                 LEFT JOIN players AS opponents ON players.ID != opponents.ID AND (opponents_match.player1_id = opponents.ID OR opponents_match.player2_id = opponents.ID)
                                 WHERE CONCAT(players.first_name, ' ', players.last_name) = :search_query
                                 ORDER BY matches.tourn_name, matches.match_date, sets.set_number");

            $stmt->bindParam(':search_query', $search_query, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $playerInfo = ($result) ? $result[0] : null;

        } catch (PDOException $ex) {
            echo "Query failed: " . $ex->getMessage();
        }
    }
}


try {
    $query = $pdo->query("SELECT * FROM players");
    $players = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo "Query failed: " . $ex->getMessage();
}try {
     $query = $pdo->query("SELECT tournaments.tourn_name, tournaments.location, tournaments.start_date, tournaments.end_date, 
                   CONCAT(players.first_name, ' ', players.last_name) AS winner_name
            FROM players
            JOIN (
                SELECT tourn_name, MAX(match_date) AS max_match_date, winner_id
                FROM matches
                GROUP BY tourn_name
            ) AS max_matches ON players.ID = max_matches.winner_id
            JOIN tournaments ON max_matches.tourn_name = tournaments.tourn_name");
    $tournaments = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo "Query failed: " . $ex->getMessage();
}
try {
    $query = $pdo->query("SELECT * FROM players WHERE status = 'Active' ORDER BY points DESC");
    $rankings = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
echo "Query failed: " . $ex->getMessage();}

try {
    $query = $pdo->query("SELECT * FROM players WHERE status = 'Retired'");
    $retired = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
echo "Query failed: " . $ex->getMessage();}
//INITIAL POINTS ASSIGNMENT

?>
