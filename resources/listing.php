<?php
//$dbPath = 'database/osts.db';
if (!file_exists($dbPath)) { 
    die("Error: Database file not found at $dbPath");
}

try {
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "<pre class='debug'>Debug: Database connection established</pre>\n";

    // Get filter tag if it exists
    $filterTag = isset($_GET['tags']) ? trim($_GET['tags']) : null;
    
    if ($filterTag) {
        $query = "SELECT * FROM $page WHERE tags LIKE :tag 
                 ORDER BY CASE WHEN date_order IS NULL THEN id ELSE date_order END DESC";
        $stmt = $db->prepare($query);
        $stmt->execute([':tag' => '%' . $filterTag . '%']);
        $result = $stmt;
        echo "<a href=\"/blog\">Clear Tags</a>";
    } else {
        $query = "SELECT * FROM $page 
                 ORDER BY CASE WHEN date_order IS NULL THEN id ELSE date_order END DESC";
        //echo "<pre class='debug'>Debug: Query: " . htmlspecialchars($query) . "</pre>\n";
        $result = $db->query($query);
    }
    
    //echo "<pre class='debug'>Debug: Query executed</pre>\n";
    
    if ($result) {
        $projectCount = 0;
        //echo "<pre class='debug'>Debug: Starting row fetch loop</pre>\n";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Debug row data
            //echo "<pre class='debug'>Debug: Row data - ID: " . $row['id'] . 
            //     ", Show: '" . $row['show'] . 
            //     "', File name: " . $row['file_name'] . 
            //     ", Date order: " . $row['date_order'] . "</pre>\n";

            // Skip if show is '0'
            if ($row['show'] === '0') {
                //echo "<pre class='debug'>Debug: Skipping row " . $row['id'] . " because show = '0'</pre>\n";
                continue;
            }

            //echo "<pre class='debug'>Debug: Processing row ID: " . htmlspecialchars($row['id']) . "</pre>\n";
            $file_name = $row['file_name'];
            $header = $row['header'];
            $date_splash = $row['date_splash'];
            $tags = $row['tags'];
            $preview_html = substr($row['preview_html'], 0, 1500);
            if (strlen($row['preview_html']) > 1500) {
                $preview_html .= '...';
            }
            echo "<div>\n";
            // HEADER
            echo !empty($file_name)
                ? " <h3 class=\"post-title\"><a class=\"cool-link\" href=\"/$page/" . htmlspecialchars($row['file_name']) . ".php\">" . htmlspecialchars($row['header']) . "</a></h3>\n"
                : " <h3 class=\"post-title\">" . htmlspecialchars($header) . "</h3>\n";
        
            include $attributes;//'post-attrs.php';

            echo "    <p class=\"post-beginning\">" . $preview_html . "</p>\n";
            echo "</div>\n\n";

            $projectCount++;
            //echo "<pre class='debug'>Debug: Project count: " . $projectCount . "</pre>\n";
            if ($projectCount >= $count) {
                //echo "<pre class='debug'>Debug: Reached count limit: " . $count . "</pre>\n";
                break;
            }
        }
        //echo "<pre class='debug'>Debug: Finished processing all rows</pre>\n";
    } else {
        //echo "<pre class='debug'>Debug: No results found</pre>\n";
        echo "No posts found.";
    }
} catch(PDOException $e) {
    //echo "<pre class='debug'>Database Error: " . htmlspecialchars($e->getMessage()) . "</pre>\n";
    echo "Error: " . htmlspecialchars($e->getMessage());
} catch(Exception $e) {
    //echo "<pre class='debug'>General Error: " . htmlspecialchars($e->getMessage()) . "</pre>\n";
    echo "Error: " . htmlspecialchars($e->getMessage());
}
//echo "<pre class='debug'>Debug: Script completed</pre>\n";
?>