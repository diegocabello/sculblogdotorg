<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// If the parameters are not set, default them
$isRandom = isset($isRandom) ? $isRandom : false;
$count = isset($count) ? $count : null;
$page = isset($page) ? $page : null;
$showPage = isset($showPage) ? $showPage : true;

// Debug output for input parameters
// echo "Debug - isRandom: " . ($isRandom ? 'true' : 'false') . "<br>";
// echo "Debug - count: " . ($count ?? 'null') . "<br>";
// echo "Debug - page: " . ($page ?? 'null') . "<br>";

// Database file path
$dbPath = $_SERVER['DOCUMENT_ROOT'] . '/database/thoughts.db';

// Check if database file exists
if (!file_exists($dbPath)) {
    die("Error: Database file not found at $dbPath");
}

try {
    // Connect to the SQLite database
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Successfully connected to the database.<br>";

    // Verify table existence and structure
    $tableCheck = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='thoughts'");
    if (!$tableCheck->fetch()) {
        die("Error: 'thoughts' table does not exist in the database.");
    }

    // Check for data in the table
    $countCheck = $db->query("SELECT COUNT(*) FROM thoughts")->fetchColumn();
    // echo "Total records in thoughts table: $countCheck<br>";

    // Construct the base query
    $query = "SELECT * FROM thoughts";
    $params = [];

    // Add a WHERE clause if the 'page' parameter is provided
    // if ($page) {
    //     $query .= " WHERE page = :page";
    //     $params[':page'] = $page;
    // }

    // Add ORDER BY clause if random is true
    if ($isRandom) {
        $query .= " ORDER BY RANDOM()";
    } else {
        $query .= " ORDER BY id DESC";
    }

    // Add LIMIT clause if count is provided
    if ($count) {
        $query .= " LIMIT :count";
        $params[':count'] = (int)$count;
    }

    // echo "Debug - Constructed query: $query<br>";
    // echo "Debug - Query parameters: " . print_r($params, true) . "<br>";

    // Prepare and execute the query
    $stmt = $db->prepare($query);
    $stmt->execute($params);

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if the query returned any results
    if ($results) {
        // echo "Query returned " . count($results) . " results.<br>";
        // Loop through each row and format it as required
        foreach ($results as $row) {
            if ($row['show'] === '0') {
                continue;
            }
            echo '<div class="grid-one-five" style="margin-top: .5em; margin-bottom: .5em;">';
            echo '<div>';
            if ($showPage) {
                echo '<p style="text-transform: capitalize; text-align: center; margin-top: 0; margin-bottom: 0;">' . htmlspecialchars($row['page'] ?? 'N/A') . '</p>';
            }
            echo '<p style="text-align: center; margin-top: 0; margin-bottom: 0;">' . str_replace('T', ' ', substr(htmlspecialchars($row['timestamp'] ?? 'N/A'), 0, -7)) . '</p>';
            echo '</div>';
            echo '<p style="text-indent: 0; margin-top: 0; margin-bottom: 0; padding-top: auto; padding-bottom: auto;">' . nl2br(htmlspecialchars($row['text'] ?? 'N/A')) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No entries found.</p>';
    }
} catch(PDOException $e) {
    echo "Database Error: " . $e->getMessage();
} catch(Exception $e) {
    echo "General Error: " . $e->getMessage();
}
?>
