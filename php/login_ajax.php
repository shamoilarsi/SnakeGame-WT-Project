<?php
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    // Create connection
    $conn = new mysqli("127.0.0.1", "root", "root123", "Snake");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username=\"".$username."\"";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($password == $row["password"]){
                echo "OK";

                $sql = "SELECT max FROM leaderboard WHERE username=\"".$username."\"";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "#".$row['max'];
            }
            else {
                echo "Wrong Password";
            }
        }
    } else {
        echo "Wrong Username";
    }



    $conn->close();

?>
