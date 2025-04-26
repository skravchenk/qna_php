<?php
function loadPortfolioFromJSON(string $filePath = 'data/portfolio.json'): array {
    if (!file_exists($filePath)) return [];

    $json = file_get_contents($filePath);
    $data = json_decode($json, true);

    return $data['portfolio'] ?? [];
}

function renderPortfolioItems() {
    $items = loadPortfolioFromJSON();

    echo '<div class="portfolio-grid">';
    foreach ($items as $item) {
        echo '
        <div class="portfolio-item">
            <a href="' . htmlspecialchars($item['url']) . '" target="_blank">
                <img src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['title']) . '">
                <p>' . htmlspecialchars($item['title']) . '</p>
            </a>
        </div>';
    }
    echo '</div>';
}
?>
