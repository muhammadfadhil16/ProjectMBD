<?php
include('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_notification'])) {
        $id_user = $_POST['id_user'];
        $isi_notifikasi = $_POST['isi_notifikasi'];

        if (empty($id_user) || empty($isi_notifikasi)) {
            header('Location: index.php?message=All fields are required!');
            exit();
        } else {
            $insertQuery = "INSERT INTO Notifikasi (id_user, isi_notifikasi) VALUES ('$id_user', '$isi_notifikasi')";
            $insertResult = mysqli_query($connection, $insertQuery);

            if (!$insertResult) {
                die("Query Failed: " . mysqli_error($connection));
            } else {
                header('Location: index.php?insert_msg=Notification has been added successfully!');
                exit();
            }
        }
    }
}
?>
