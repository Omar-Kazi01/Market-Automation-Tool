<?php
// Include the shared database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tags = $_POST['tags'];

    // Insert into the contacts table
    $sql = "INSERT INTO contacts (name, email, tags) VALUES ('$name', '$email', '$tags')";

    if ($conn->query($sql) === TRUE) {
        echo "New contact added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2a7ae2;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #2a7ae2;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1558b0;
        }

        a.back-link {
            display: inline-block;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
        }

        a.back-link:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            color: #888;
            font-size: 14px;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>➕ Add New Contact</h2>
    <form action="add_contact.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="tags" placeholder="Tags (comma-separated)">
        <button type="submit">Add Contact</button>
    </form>
    <a href="manage_contacts.php" class="back-link">← Back to Contacts</a>
</div>


<footer>
<div style="margin-bottom: 10px;">
        <a href="admin_index.php" style="
            display: inline-block;
            color: #2a7ae2;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
        ">
            ← Back to Dashboard
        </a>
    </div>
        &copy; <?php echo date('Y'); ?> Marketing Automation Tool
    </footer>
</body>
</html>

