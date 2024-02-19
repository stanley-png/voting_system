<?php
include 'admin_functions.php';

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['candidate_image'])) {
    $candidate_name = $_POST["candidate_name"];
    $image_url = upload_image($_FILES['candidate_image'], 'candidates/');

    if ($image_url && add_candidate($candidate_name, $image_url)) {
        echo "<p class='success'>Candidate added successfully.</p>";
    } else {
        echo "<p class='error'>Error adding candidate. Please try again.</p>";
    }
}
?>

<!-- Admin Controls -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="candidate_name">Candidate Name:</label>
    <input type="text" name="candidate_name" required>

    <label for="candidate_image">Candidate Image:</label>
    <input type="file" name="candidate_image" accept="image/*" required>

    <button type="submit">Add Candidate</button>
</form>
