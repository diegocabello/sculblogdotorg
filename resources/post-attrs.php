
    <!-- // ATTRIBUTES
    echo "    <div class=\"grid\" style=\"margin-bottom: 20;\">\n";
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Date: </strong>" . $row['date_splash'] . "</p>";
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Tags: </strong>" . $row['tags'] . "</p>";
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Words: </strong>" . $row['word_count'] . "</p>";
    echo "    </div>\n"; -->

<?php
// Process tags into clickable links while keeping the same layout
$tagArray = explode(', ', $row['tags']);
$tagLinks = array_map(function($tag) use ($page) {
    return "<a href='/$page/?tags=" . urlencode(trim($tag)) . "'>" . 
           htmlspecialchars(trim($tag)) . "</a>";
}, $tagArray);

echo " <div class=\"grid\" style=\"margin-bottom: 20;\">\n";
echo " <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Date: </strong>" . $row['date_splash'] . "</p>";
echo " <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Tags: </strong>" . implode(', ', $tagLinks) . "</p>";
echo " <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Words: </strong>" . $row['word_count'] . "</p>";
echo " </div>\n";
?>