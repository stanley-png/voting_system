<?php
include 'config.php';

function get_candidates() {
    global $conn;
    $sql = "SELECT * FROM candidates";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result : false;
}

function vote($voter_name, $candidate_id) {
    global $conn;
    $voter_name = $conn->real_escape_string($voter_name);
    $candidate_id = (int)$candidate_id;

    $existing_voter = get_voter($voter_name);

    if ($existing_voter && $existing_voter['voted_candidate_id'] === null) {
        $sql = "UPDATE voters SET voted_candidate_id = $candidate_id WHERE name = '$voter_name'";
        return $conn->query($sql);
    }

    return false;
}

function get_voter($voter_name) {
    global $conn;
    $voter_name = $conn->real_escape_string($voter_name);
    $sql = "SELECT * FROM voters WHERE name = '$voter_name'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result->fetch_assoc() : false;
}
?>
