<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'db.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$log_output = "";

// Fetch all scheduled campaigns
$stmt = $conn->prepare("SELECT * FROM campaigns WHERE status = 'scheduled' AND scheduled_time <= NOW()");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($campaign = $result->fetch_assoc()) {
        $log_output .= "<hr>";
        $log_output .= "Campaign found: {$campaign['subject']}<br>";
        $log_output .= "Scheduled time: {$campaign['scheduled_time']}<br>";

        // Fetch contacts
        $contacts = $conn->query("SELECT name, email FROM contacts");

        if ($contacts->num_rows > 0) {
            while ($row = $contacts->fetch_assoc()) {
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'MarketAT001@gmail.com';
                    $mail->Password   = 'itjc suug rbbx gekx';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    $mail->setFrom('MarketAT001@gmail.com', 'ADMIN');
                    $mail->addAddress($row['email'], $row['name']);

                    $mail->isHTML(true);
                    $mail->Subject = $campaign['subject'];
                    $mail->Body    = $campaign['message'];

                    $mail->send();
                    $log_output .= "Email sent to {$row['name']}<br>";
                } catch (Exception $e) {
                    $log_output .= "Failed to send to {$row['name']}: {$mail->ErrorInfo}<br>";
                }
            }
        } else {
            $log_output .= "No contacts found.<br>";
        }

        // Mark campaign as sent
        $update = $conn->prepare("UPDATE campaigns SET status = 'sent' WHERE id = ?");
        $update->bind_param("i", $campaign['id']);
        $update->execute();

        $log_output .= "Campaign status updated to 'sent'.<br>";
    }
} else {
    $log_output .= "No scheduled campaigns found.<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Campaign</title>
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

        .log {
            font-size: 15px;
            color: #333;
            line-height: 1.6;
        }

        footer {
            text-align: center;
            color: #888;
            font-size: 14px;
            margin-top: 60px;
        }

        a.back-link {
            display: inline-block;
            color: #2a7ae2;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Campaign Dispatch Status</h2>
        <div class="log">
            <?php echo $log_output; ?>
        </div>
    </div>

    <footer>
        <a href="admin_index.php" class="back-link">← Back to Dashboard</a>
        &copy; <?php echo date('Y'); ?> Marketing Automation Tool
    </footer>
</body>
</html>
