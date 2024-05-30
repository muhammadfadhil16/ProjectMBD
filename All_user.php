<?php
include('dbcon.php');

// Query untuk mengambil semua data pengguna
$query = "SELECT user_id, username, password, role FROM User";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>
<body>
    <h1>All Users</h1>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
        </tr>
        <?php
        // Menampilkan data pengguna dalam tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="add_user.php">Add New User</a>
</body>
</html>

<?php
// Membebaskan hasil query dan menutup koneksi
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
