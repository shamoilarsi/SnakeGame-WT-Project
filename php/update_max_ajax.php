<?php
    $username = $_REQUEST["username"];
    $max = $_REQUEST["max"];


    // Create connection
    $conn = new mysqli("127.0.0.1", "root", "root123", "Snake");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE leaderboard SET max=".$max." WHERE username='".$username."'";

    if ($conn->query($sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>