<?php
include('dbcon.php');

$query = "SELECT Peminjaman.id_peminjaman, User.username, Ruangan.nama_ruangan, Peminjaman.tanggal_peminjaman, Peminjaman.jam_mulai, Peminjaman.jam_selesai, Peminjaman.keperluan 
          FROM Peminjaman
          JOIN User ON Peminjaman.id_user = User.id_user
          JOIN Ruangan ON Peminjaman.id_ruangan = Ruangan.id_ruangan";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>ID Peminjaman</th>
                <th>Username</th>
                <th>Nama Ruangan</th>
                <th>Tanggal Peminjaman</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Keperluan</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_peminjaman']}</td>
                <td>{$row['username']}</td>
                <td>{$row['nama_ruangan']}</td>
                <td>{$row['tanggal_peminjaman']}</td>
                <td>{$row['jam_mulai']}</td>
                <td>{$row['jam_selesai']}</td>
                <td>{$row['keperluan']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found.";
}
?>
