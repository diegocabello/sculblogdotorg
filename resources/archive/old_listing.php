<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$page = 'blog'; // this is used to highlight the header, choose the thoughts category, and do the highlights for the 'back to' buttons

if (!isset($file_name) || empty($file_name)) {
    die("Error: file name is not provided");
}

$dbPath = '../database/db.db';
if (!file_exists($dbPath)) {
    die("Error: Database file not found at $dbPath");
}

try {
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM $page WHERE file_name = :file_name";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Start of the HTML
        echo <<<EOT
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>{$row['header']}</title>
    <style>
    p {
        text-indent: 60px;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    </style>
</head>
<body>
EOT;
        include '../header.php';
        echo <<<EOT
<div style="height: 60px;"></div>
<div class="content">
    <div class="content-main">
        <a href="../$page">&lt;&lt;&lt;Back to 
EOT;
        echo ucfirst($page);
        echo <<<EOT
</a>
        <h2 style="margin-bottom: 0;">{$row['header']}</h2>
EOT;
        include './attrs.php';
        echo <<<EOT
        {$row['text']}
    </div>
    <div id="thoughts-div">
        <h3>Thoughts</h3>
EOT;
        $isRandom = false;
        $count = 3;
        $showPage = false;
        include '../thoughts.php';
        echo <<<EOT
        <a href="../$page">&lt;&lt;&lt;Back to 
EOT;
        echo ucfirst($page);
        echo <<<EOT
</a>
    </div>
</div>
EOT;
        include '../footer.php';
        echo <<<EOT
</body>
</html>
EOT;
    } else {
        echo "No posts found for file name $file_name";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
