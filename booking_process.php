<?php
include('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['room_id'])) {
        $roomID = $_POST['room_id'];

        // Lakukan proses pemesanan ruangan sesuai kebutuhan, misalnya, masukkan data ke tabel peminjaman
        // Contoh sederhana, hanya menampilkan pesan
        echo "Room booked successfully with ID: $roomID";
    } else {
        echo "No room selected.";
    }
} else {
    header('Location: user_bookings.php');
    exit();
}
?>
