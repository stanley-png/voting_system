<?php
include 'config.php';

function add_candidate($name, $image_url) {
    global $conn;
    $name = $conn->real_escape_string($name);
    $image_url = $conn->real_escape_string($image_url);
    $sql = "INSERT INTO candidates (name, image_url) VALUES ('$name', '$image_url')";
    return $conn->query($sql);
}

function upload_image($file, $upload_dir) {
    $target_dir = $upload_dir;
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<p class='error'>File is not an image.</p>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<p class='error'>Sorry, file already exists.</p>";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        echo "<p class='error'>Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<p class='error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<p class='error'>Sorry, your file was not uploaded.</p>";
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "<p class='error'>Sorry, there was an error uploading your file.</p>";
            return false;
        }
    }
}

function get_all_voters() {
    global $conn;
    $sql = "SELECT * FROM voters";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result : false;
}

function get_candidate_name($candidate_id) {
    global $conn;
    $candidate_id = (int)$candidate_id;
    $sql = "SELECT name FROM candidates WHERE id = $candidate_id";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result->fetch_assoc()['name'] : false;
}
?>
