<?php
include 'admin_functions.php';

// Display Voters and Candidates in Dashboard
echo "<h3>Voters:</h3>";
$voters = get_all_voters();
if ($voters) {
    while ($row = $voters->fetch_assoc()) {
        echo "<div class='voter'>";
        echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
        echo "<p>Name: " . $row['name'] . "</p>";
        echo "<p>Voted Candidate: " . ($row['voted_candidate_id'] ? get_candidate_name($row['voted_candidate_id']) : 'Not voted yet') . "</p>";
        echo "</div>";
    }
} else {
    echo "<p class='error'>No voters available.</p>";
}

echo "<h3>Candidates:</h3>";
$candidates = get_candidates();
if ($candidates) {
    while ($row = $candidates->fetch_assoc()) {
        echo "<div class='candidate'>";
        echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
        echo "<p>Name: " . $row['name'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p class='error'>No candidates available.</p>";
}
?>
