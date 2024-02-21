<?php
require __DIR__ . '/../config/db.php'; 
require __DIR__ . '/../src/MailQueue.php';
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';

if (!empty($email) && !empty($name) && !empty($phone)) {
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, phone, email) VALUES (?, ?, ?)");
        $stmt->execute([$name, $phone, $email]);

        $mailQueue = new MailQueue($pdo);
        $mailQueue->enqueueMail($email, $name);

        $pdo->commit();

        echo "Registration successful. Please check your email.";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $pdo->rollback();
        echo "An error occurred. Please try again later.";
    }
} else {
    echo "Please fill all the fields.";
}
?>
