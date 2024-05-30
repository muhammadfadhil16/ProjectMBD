<?php
include('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $userID = $_GET['id'];

    // Delete the user record
    $deleteUserQuery = "DELETE FROM User WHERE id_user=$userID";
    $deleteUserResult = mysqli_query($connection, $deleteUserQuery);

    if (!$deleteUserResult) {
        die("Query Failed: " . mysqli_error($connection));
    }

    header('Location: index.php?delete_msg=User data has been deleted successfully!');
    exit();
}
?>
