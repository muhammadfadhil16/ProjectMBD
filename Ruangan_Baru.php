<?php
include('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_room'])) {
        $nama_ruangan = $_POST['nama_ruangan'];
        $kapasitas = $_POST['kapasitas'];

        if (empty($nama_ruangan)) {
            header('Location: index.php?message=You need to fill in the room name!');
            exit();
        } elseif (empty($kapasitas)) {
            header('Location: index.php?message=You need to fill in the capacity!');
            exit();
        } else {
            $insertQuery = "INSERT INTO ruangan (nama_ruangan, kapasitas) VALUES ('$nama_ruangan', '$kapasitas')";
            $insertResult = mysqli_query($connection, $insertQuery);

            if (!$insertResult) {
                die("Query Failed: " . mysqli_error($connection));
            } else {
                header('Location: index.php?insert_msg=Room has been added successfully!');
                exit();
            }
        }
    }
}
?>
