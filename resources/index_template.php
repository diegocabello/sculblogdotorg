<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">  
    <title>Blog</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div style="height: 60px;"></div>
        <div class="content">
    	<?php $count = 999; $dbPath = '../database/db.db'; include 'listing.php'; ?>
    	<h3>Thoughts</h3>
    	<div class="subsection">
    		<?php 
    			$isRandom = false;
    			$showPage = false;
    			include '../thoughts.php'; 
    		?>
    	</div>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
