<?php
include('dbcon.php');

// Query untuk mengambil semua ruangan yang tersedia
$query = "SELECT * FROM ruangan WHERE tersedia = 1";
$result = mysqli_query($connection, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['room_id'])) {
        $roomID = $_POST['room_id'];

        // Perbarui status tersedia ruangan
        $updateQuery = "UPDATE ruangan SET tersedia = 0 WHERE id_ruangan = ?";
        $stmt = mysqli_prepare($connection, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'i', $roomID);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Room booked successfully with ID: $roomID";
        } else {
            echo "Failed to update room availability.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "No room selected.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bookings</title>
</head>
<body>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<h1>Available Rooms</h1>";
        echo "<form action='' method='POST'>";
        echo "<table border='1'>
                <tr>
                    <th>ID Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Action</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id_ruangan']}</td>
                    <td>{$row['nama_ruangan']}</td>
                    <td>{$row['kapasitas']}</td>
                    <td><input type='radio' name='room_id' value='{$row['id_ruangan']}' required></td>
                  </tr>";
        }
        echo "</table>";
        echo "<input type='submit' name='submit' value='Book Room'>";
        echo "</form>";
    } else {
        echo "No available rooms found.";
    }
    ?>
</body>
</html>
