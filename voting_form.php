<?php
include 'voting_functions.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voter_name = $_POST["voter_name"];
    $candidate_id = $_POST["candidate_id"];

    if (vote($voter_name, $candidate_id)) {
        echo "<p class='success'>Vote submitted successfully.</p>";
    } else {
        echo "<p class='error'>Error submitting vote. Please try again.</p>";
    }
}
?>

<!-- Display Candidates for Voting -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="voter_name">Your Name:</label>
    <input type="text" name="voter_name" required>

    <h3>Select Your Candidate:</h3>

    <?php
    $candidates = get_candidates();
    if ($candidates) {
        while ($row = $candidates->fetch_assoc()) {
            echo "<div class='candidate'>";
            echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
            echo "<label>";
            echo "<input type='radio' name='candidate_id' value='" . $row['id'] . "' required>" . $row['name'];
            echo "</label>";
            echo "</div>";
        }
        echo "<button type='submit'>Vote</button>";
    } else {
        echo "<p class='error'>No candidates available.</p>";
    }
    ?>
</form>
