<?php
include('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_schedule'])) {
        $id_ruangan = $_POST['id_ruangan'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        if (empty($id_ruangan) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)) {
            header('Location: index.php?message=All fields are required!');
            exit();
        } else {
            $insertQuery = "INSERT INTO Jadwal (id_ruangan, hari, jam_mulai, jam_selesai) VALUES ('$id_ruangan', '$hari', '$jam_mulai', '$jam_selesai')";
            $insertResult = mysqli_query($connection, $insertQuery);

            if (!$insertResult) {
                die("Query Failed: " . mysqli_error($connection));
            } else {
                header('Location: index.php?insert_msg=Schedule has been added successfully!');
                exit();
            }
        }
    }
}
?>
