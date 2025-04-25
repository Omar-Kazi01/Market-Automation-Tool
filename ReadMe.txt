Marketing Automation Tool
Overview
This is a simple PHP-based Marketing Automation Tool that allows users to manage contacts, create campaigns, and send emails to the contacts at a scheduled time. The system allows campaign creators to easily set up campaigns, and it sends the emails automatically at the scheduled time.

Key Features
Add Contacts: Add new contacts to your marketing tool with name and email.

Create Campaigns: Create campaigns with a subject, message, and scheduled time.

Send Emails: The tool automatically sends emails to all contacts for a campaign when the scheduled time is reached.

Campaign Management: View all campaigns and their statuses (Scheduled/Sent).

Technologies Used
PHP for the backend and logic.

MySQL for storing contact and campaign data.

PHPMailer to send emails.

XAMPP for local development environment.

Installation
Prerequisites
XAMPP or any local server with PHP and MySQL.

PHPMailer library (included in the project).

Steps to Set Up
Clone the Repository or download the project files.

Install XAMPP and ensure Apache and MySQL are running.

Create a Database:

Open phpMyAdmin (typically at http://localhost/phpmyadmin).

Create a new database, for example: marketing_tool.

Import the database structure from marketing_tool.sql (if provided).

Configure the Database:

Open db.php and configure your database connection with the appropriate details (hostname, username, password, and database name).

Set Up SMTP:

Update the send_email.php file with your SMTP credentials (email and password).

You can use Gmail SMTP or any other email service provider.

Run the Application:

Place all files in the htdocs directory (e.g., C:\xampp\htdocs\marketing-tool).

Visit http://localhost/marketing-tool/ in your browser.