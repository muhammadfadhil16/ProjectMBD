<?php
include('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_students'])) {
        $userID = $_POST['user_id'];
        $newUsername = $_POST['new_username'];
        $newPassword = $_POST['new_password'];
        $newRole = $_POST['new_role'];

        // Update the user record
        $updateUserQuery = "UPDATE User SET username='$newUsername', password='$newPassword', role='$newRole' WHERE id_user=$userID";
        $updateUserResult = mysqli_query($connection, $updateUserQuery);

        if (!$updateUserResult) {
            die("Query Failed: " . mysqli_error($connection));
        }

        header('Location: index.php?update_msg=User data has been updated successfully!');
        exit();
    }
}
?>
