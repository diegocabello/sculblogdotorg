<?php
    echo "    <div class=\"grid\" style=\"margin-bottom: 20;\">\n";
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Dates: </strong>" . htmlspecialchars($row['date_splash']) . "</p>\n";
    $completionClass = strtolower($row['completion']);
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Completion: </strong><span class=\"$completionClass\">" . htmlspecialchars($row['completion']) . "</span></p>\n";
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Links: </strong>";
    $links = explode(',', $row['links']);
    $formattedLinks = [];
    foreach ($links as $link) {
        if (preg_match('/\[(.*?)\]\((.*?)\)/', trim($link), $matches)) {
            $text = $matches[1];
            $url = $matches[2];
            $formattedLinks[] = "<a href=\"$url\" target=\"_blank\" class=\"cool-link\" style=\"margin-bottom: 20;\">" . htmlspecialchars($text) . "</a>";
        }
    }
    echo implode(' ', $formattedLinks);
    echo "</p>\n";
    echo "        <p class=\"blog-date\" style=\"margin-bottom: 0;\"><strong>Skillset: </strong>" . htmlspecialchars($row['tags']) . "</p>\n";
    echo "    </div>\n";
?>
