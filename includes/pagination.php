<!-- includes/pagination.php -->

<?php
$totalPages = ceil(getTotalRecords($conn) / $recordsPerPage);

if ($totalPages > 1) {
    echo "<div class='pagination'>";
    if ($currentPage > 1) {
        echo "<a href='index.php?page=" . ($currentPage - 1) . "'>Previous</a>";
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='index.php?page=$i'>$i</a>";
    }
    if ($currentPage < $totalPages) {
        echo "<a href='index.php?page=" . ($currentPage + 1) . "'>Next</a>";
    }
    echo "</div>";
}
?>
