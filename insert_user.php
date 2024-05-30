<?php
include('dbcon.php');

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $role = trim($_POST['role']);

        // Validasi input
        if (empty($username) || empty($password) || empty($role)) {
            header('Location: add-user.php?message=All fields are required!');
            exit();
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $insertUserQuery = "INSERT INTO User (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insertUserQuery);

        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, 'sss', $username, $hashedPassword, $role);
        mysqli_stmt_execute($stmt);

        // Cek apakah query berhasil dieksekusi
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Redirect ke halaman user_bookings.php dengan parameter user_id
            header('Location: user_bookings.php?user_id=' . mysqli_insert_id($connection));
            exit();
        } else {
            header('Location: index.php?message=Failed to add user!');
            exit();
        }

        mysqli_stmt_close($stmt);
    }

?>
