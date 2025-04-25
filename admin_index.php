<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>📬 Marketing Automation Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f2f2f2;
        }

        header {
            background-color: #2a7ae2;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1, h2 {
            margin: 0 0 15px;
        }

        a.button {
            display: inline-block;
            background: #2a7ae2;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }

        a.button:hover {
            background: #1558b0;
        }

        footer {
            text-align: center;
            color: #888;
            font-size: 14px;
            margin-top: 60px;
        }
        div {
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <h1>📬 Marketing Automation Tool</h1>
        <p>Manage Contacts and Campaigns</p>
    </header>

    <div class="container">
        <div class="card">
            <h2>🚀 Quick Actions</h2>
            <a href="admin_add_contact.php" class="button">Add Contact</a> 
            <a href="manage_contacts.php" class="button">Manage Contacts</a>
            <a href="admin_create_campaign.php" class="button">Create Campaign</a> 
            <a href="manage_campaigns.php" class="button">Manage Campaigns</a>
            <a href="send_email.php" class="button"> Send Emails</a> 
        </div>
    </div>

    <footer>
        <a href="index.php" style="color: #aaa; font-size: 12px; text-decoration: none; margin-left: 10px;">Back to User Dashboard?</a>
        &copy; <?php echo date('Y'); ?> Marketing Automation Tool
    </footer>

</body>