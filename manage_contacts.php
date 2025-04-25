<?php
include 'db.php';

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt_delete = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt_delete->bind_param("i", $delete_id);
    $stmt_delete->execute();
}

// Fetch all contacts
$stmt = $conn->prepare("SELECT * FROM contacts ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Contacts</title>
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

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a,
        .actions button {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #4caf50;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .actions a:hover,
        .actions button:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
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

        .add-btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #2a7ae2;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: #1558b0;
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

<h1>Manage Contacts</h1>

<a href="admin_add_contact.php" class="add-btn">➕ Add New Contact</a>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($contact = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $contact['id']; ?></td>
                    <td><?php echo $contact['name']; ?></td>
                    <td><?php echo $contact['email']; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></td>
                    <td class="actions">
                        <a href="edit_contact.php?id=<?php echo $contact['id']; ?>" class="edit-btn">Edit</a>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $contact['id']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No contacts found.</p>
<?php endif; ?>
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
