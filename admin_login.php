<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $correct_password = 'iamadmin'; // You can store this in env/config file

    if ($password === $correct_password) {
        $_SESSION['is_admin'] = true;
        header("Location: admin_index.php");
        exit;
    } else {
        $error = "Incorrect password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="password" name="password" placeholder="Enter admin password" required>
        <button type="submit">Login</button>
    </form>
    <br>
    <a href="index.php">← Back</a>
    <style>
    footer {
            text-align: center;
            color: #888;
            font-size: 14px;
            margin-top: 60px;
        }
    </style>
    <footer>
        &copy; <?php echo date('Y'); ?> Marketing Automation Tool
    </footer>
</body>
</html>