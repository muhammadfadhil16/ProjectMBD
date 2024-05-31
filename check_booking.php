<?php
include('header.php');
include('dbcon.php');

// Pastikan user_id tersedia dan valid
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $userID = $_GET['user_id'];

    // Query untuk mengambil data peminjaman ruangan oleh pengguna tertentu
    $query = "SELECT * FROM Peminjaman WHERE id_user = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
} else {
    die("Invalid User ID");
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
    <h1>User Bookings</h1>
    <table class='table table-hover table-bordered table-striped'>">
        <tr>
            <th>Booking ID</th>
            <th>Room ID</th>
            <th>Date</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
        <?php
        // Menampilkan data peminjaman ruangan oleh pengguna dalam tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_peminjaman']) . "</td>";
            echo "<td>" . htmlspecialchars($row['id_ruangan']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tanggal_peminjaman']) . "</td>";
            // Tambahkan kolom lain sesuai kebutuhan
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Membebaskan hasil query dan menutup koneksi
mysqli_free_result($result);
mysqli_close($connection);
?>
