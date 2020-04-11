<?php
    
    // Create connection
    $conn = new mysqli("127.0.0.1", "root", "root123", "Snake");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT username, max FROM leaderboard ORDER BY max DESC LIMIT 10";
    $result = $conn->query($sql);

    echo '<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Max Score</th>
      </tr>
    </thead>
    <tbody>';

    $c = 1;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            echo "<tr>";
            echo '<th scope="row">'.$c.'</th>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['max'] . '</td>';

            $c += 1;
            echo "</tr>";
        }
    } else {
        echo "No Entries";
    }
    echo '  </tbody>
    </table>';

    $conn->close();


?>