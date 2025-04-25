<?php
include 'db.php';  // Include database connection

// Fetch all scheduled campaigns
$stmt_scheduled = $conn->prepare("SELECT * FROM campaigns WHERE status = 'scheduled' ORDER BY scheduled_time ASC");
$stmt_scheduled->execute();
$result_scheduled = $stmt_scheduled->get_result();

// Fetch all sent campaigns
$stmt_sent = $conn->prepare("SELECT * FROM campaigns WHERE status = 'sent' ORDER BY scheduled_time ASC");
$stmt_sent->execute();
$result_sent = $stmt_sent->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Campaigns</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #e9eff6;
        }

        h1 {
            color: #2a7ae2;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2a7ae2;
            color: white;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            padding: 5px 10px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .actions a.delete {
            background-color: #f44336;
        }

        .actions a:hover {
            background-color: #555;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container a {
            padding: 10px 20px;
            background-color: #2a7ae2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-container a:hover {
            background-color: #1e6bb8;
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

    <h1>View Campaigns</h1>

    <!-- Scheduled Campaigns Table -->
    <h2>Scheduled Campaigns</h2>
    <?php if ($result_scheduled->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Scheduled Time</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($campaign = $result_scheduled->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $campaign['id']; ?></td>
                        <td><?php echo $campaign['subject']; ?></td>
                        <td><?php echo ucfirst($campaign['status']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($campaign['scheduled_time'])); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($campaign['created_at'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No scheduled campaigns found.</p>
    <?php endif; ?>

    <!-- Sent Campaigns Table -->
    <h2>Sent Campaigns</h2>
    <?php if ($result_sent->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Scheduled Time</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($campaign = $result_sent->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $campaign['id']; ?></td>
                        <td><?php echo $campaign['subject']; ?></td>
                        <td><?php echo ucfirst($campaign['status']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($campaign['scheduled_time'])); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($campaign['created_at'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No sent campaigns found.</p>
    <?php endif; ?>

    <div class="button-container">
        <a href="create_campaign.php">Create New Campaign</a>
        <a href="index.php">Back to Dashboard</a>
    </div>
    <footer>
        &copy; <?php echo date('Y'); ?> Marketing Automation Tool
    </footer>
</body>
</html>
