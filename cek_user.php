<?php
$conn = mysqli_connect('localhost', 'root', '', 'sewasound_db');
$result = mysqli_query($conn, "SELECT id_user, username, password, level FROM users");
echo "<h2>Daftar User di Database</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Level</th></tr>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id_user'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['level'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>