
<?php
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $email = $_REQUEST["email"];


    // Create connection
    $conn = new mysqli("127.0.0.1", "root", "root123", "Snake");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users(email, username, password) VALUES ('$email','$username','$password');";

    if ($conn->query($sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $date = date("Y-m-d");
    $sql = "INSERT INTO leaderboard (username, date) VALUES ('$username', '$date');";
    $result = $conn->query($sql);

    echo "#0";

    $conn->close();
?>
