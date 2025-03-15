<?php

function cleanInput($input = null) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function dbConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_donation";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Database Connection Error" . $conn->connect_error);
    } else {
        return $conn;
    }
}

//Email validation
function validateEmail($email, $errorMsg) {
    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $message[$errorMsg] = "The wrong email format...";
        }
    }
}

?>  