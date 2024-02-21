<?php
require __DIR__ . '/../config/db.php'; // Adjust the path as necessary
require __DIR__ . '/../src/MailQueue.php'; // Ensure this path is correct

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';

// Simple validation (extend based on your needs)
if (!empty($email) && !empty($name) && !empty($phone)) {
    // Begin transaction to ensure data integrity
    $pdo->beginTransaction();
    try {
        // Save user data to database
        $stmt = $pdo->prepare("INSERT INTO users (name, phone, email) VALUES (?, ?, ?)");
        $stmt->execute([$name, $phone, $email]);

        // Add email to queue
        $mailQueue = new MailQueue($pdo);
        $mailQueue->enqueueMail($email, $name);

        // Commit transaction
        $pdo->commit();

        echo "Registration successful. Please check your email.";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $pdo->rollback();
        // Log the error or send it back to the client as needed
        echo "An error occurred. Please try again later.";
    }
} else {
    echo "Please fill all the fields.";
}
?>
