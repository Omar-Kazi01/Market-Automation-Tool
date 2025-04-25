<?php
// Include database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $scheduled_time = $_POST['scheduled_time'];

    $status = 'scheduled'; // default status
    $created_at = date('Y-m-d H:i:s'); // current timestamp

    $sql = "INSERT INTO campaigns (subject, message, scheduled_time, status, created_at)
            VALUES ('$subject', '$message', '$scheduled_time', '$status', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        echo "Campaign created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Campaign</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
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

        input[type="text"],
        textarea,
        input[type="datetime-local"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
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
    <h2>📝 Create New Campaign</h2>
    <form action="create_campaign.php" method="POST">
        <input type="text" name="subject" placeholder="Campaign Subject" required>
        <textarea name="message" placeholder="Campaign Message (HTML allowed)" required></textarea>
        <input type="datetime-local" name="scheduled_time" required>
        <button type="submit">Create Campaign</button>
    </form>
    <p><a href="manage_campaigns.php" class="back-link">← Back to Campaigns</a></p>
    
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

