<?php

$con = new mysqli("localhost", "root", "", "hotel");

if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}


function filteration($data) {
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);                           // trim() - removes extra spaces
        $data[$key] = stripslashes($value);                  // stripslashes() - removes backslashes
        $data[$key] = htmlspecialchars($value);              // htmlspecialchars() - converts special characters to HTML entities
        $data[$key] = strip_tags($value);                    // strip_tags() - removes HTML tags
    }
    return $data;
}


function select($query, $params, $types) {
    global $con;
    $stmt = $con->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result();
}


function insert($query, $params, $types) {
    global $con;
    $stmt = $con->prepare($query);
    $stmt->bind_param($types, ...$params);
    return $stmt->execute();
}
?>
