<?php
include 'db.php';  // Include database connection

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt_delete = $conn->prepare("DELETE FROM campaigns WHERE id = ?");
    $stmt_delete->bind_param("i", $delete_id);
    $stmt_delete->execute();
}

// Fetch all campaigns
$stmt = $conn->prepare("SELECT * FROM campaigns");
$stmt->execute();
$result = $stmt->get_result();
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

        .actions form {
            display: inline;
        }

        .actions a,
        .actions button {
            padding: 5px 10px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions .delete {
            background-color: #f44336;
        }

        .actions a:hover,
        .actions button:hover {
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

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Scheduled Time</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($campaign = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $campaign['id']; ?></td>
                        <td><?php echo $campaign['subject']; ?></td>
                        <td><?php echo ucfirst($campaign['status']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($campaign['scheduled_time'])); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($campaign['created_at'])); ?></td>
                        <td class="actions">
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign?');">
                                <input type="hidden" name="delete_id" value="<?php echo $campaign['id']; ?>">
                                <button type="submit" class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No campaigns found.</p>
    <?php endif; ?>

    <div class="button-container">
        <a href="admin_create_campaign.php">Create New Campaign</a>
        <a href="admin_index.php">Back to Dashboard</a>
    </div>
    <footer>
        <a href="index.php" style="color: #aaa; font-size: 12px; text-decoration: none; margin-left: 10px;">Back to User Dashboard?</a>
        &copy; <?php echo date('Y'); ?> Marketing Automation Tool
    </footer>

</body>
</html>
