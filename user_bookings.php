<?php
include('dbcon.php');
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Validasi Form pada Sisi Server (PHP)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['room_id'])) {
        $roomID = $_POST['room_id'];

        // Query untuk memeriksa ketersediaan ruangan
        $checkAvailabilityQuery = "SELECT tersedia FROM ruangan WHERE id_ruangan = ?";
        $stmtCheck = mysqli_prepare($connection, $checkAvailabilityQuery);
        mysqli_stmt_bind_param($stmtCheck, 'i', $roomID);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);
        $rowCheck = mysqli_fetch_assoc($resultCheck);

        if ($rowCheck && $rowCheck['tersedia'] == '1') {
            $userID = $_SESSION['user_id'];

            // Perbarui status tersedia ruangan
            $updateQuery = "UPDATE ruangan SET tersedia = 0 WHERE id_ruangan = ?";
            $stmtUpdate = mysqli_prepare($connection, $updateQuery);
            mysqli_stmt_bind_param($stmtUpdate, 'i', $roomID);
            mysqli_stmt_execute($stmtUpdate);

            // Insert peminjaman ke database
            $insertQuery = "INSERT INTO Peminjaman (id_ruangan, id_user, tanggal_peminjaman, jam_mulai, jam_selesai, keperluan) VALUES (?, ?, CURDATE(), '09:00:00', '11:00:00', 'Keperluan mahasiswa')";
            $stmtInsert = mysqli_prepare($connection, $insertQuery);
            mysqli_stmt_bind_param($stmtInsert, 'ii', $roomID, $userID);
            mysqli_stmt_execute($stmtInsert);

            if (mysqli_stmt_affected_rows($stmtInsert) > 0) {
                echo "Ruangan berhasil dipesan dengan ID: $roomID pada tanggal ini.";
            } else {
                echo "Gagal memesan ruangan. Silakan coba lagi.";
            }

            mysqli_stmt_close($stmtUpdate);
            mysqli_stmt_close($stmtInsert);
        } else {
            echo "Ruangan tidak tersedia.";
        }

        mysqli_stmt_close($stmtCheck);
    } else {
        echo "Pilihan ruangan tidak valid.";
    }
}

// Query untuk mengambil semua ruangan yang tersedia
$query = "SELECT * FROM ruangan WHERE tersedia = 1";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bookings</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS Anda -->
</head>
<body>
    <h1>Book a Room</h1>
    <form method="POST">
        <label for="room">Select a room:</label>
        <select name="room_id" id="room" required>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['id_ruangan']; ?>">
                    <?php echo $row['nama_ruangan']; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit" name="submit">Book Room</button>
    </form>
</body>
</html>

<?php mysqli_close($connection); ?>
