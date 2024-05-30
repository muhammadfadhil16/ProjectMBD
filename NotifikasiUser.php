<?php
include('dbcon.php');

$id_user = $_SESSION['id_user']; // Asumsikan id_user disimpan dalam session
$query = "SELECT * FROM Notifikasi WHERE id_user = '$id_user' ORDER BY waktu DESC";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>{$row['isi_notifikasi']} ({$row['waktu']})</li>";
    }
    echo "</ul>";
} else {
    echo "No notifications found.";
}
?>
