<?php
include('dbcon.php');

$query = "SELECT * FROM ruangan";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>ID Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_ruangan']}</td>
                <td>{$row['nama_ruangan']}</td>
                <td>{$row['kapasitas']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No rooms found.";
}
?>
