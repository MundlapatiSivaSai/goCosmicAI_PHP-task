<?php
use Mailgun\Mailgun;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/db.php';

class MailQueue {
    private $pdo;
    private $mgClient;
    private $domain;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        // Initialize Mailgun client
        $this->mgClient = Mailgun::create('750319e2dbf7cb11f1a476cab88b7cf9-408f32f3-bb3a8e2e');
        $this->domain = 'sandbox10140c44e47445b89719b7b24b0e78a6.mailgun.org';
    }

    public function enqueueMail($email, $name) {
        $stmt = $this->pdo->prepare("INSERT INTO mail_queue (email, name, status, queued_at) VALUES (?, ?, 'pending', NOW())");
        $stmt->execute([$email, $name]);
    }

    public function processQueue() {
        // Retrieve up to 10 pending emails
        $stmt = $this->pdo->query("SELECT * FROM mail_queue WHERE status = 'pending' ORDER BY queued_at ASC LIMIT 10");
        $mailsToSend = $stmt->fetchAll();

        foreach ($mailsToSend as $mail) {
            if ($this->sendMail($mail['email'], $mail['name'])) {
                $updateStmt = $this->pdo->prepare("UPDATE mail_queue SET status = 'sent', sent_at = NOW() WHERE id = ?");
                $updateStmt->execute([$mail['id']]);
            } else {
                $updateStmt = $this->pdo->prepare("UPDATE mail_queue SET status = 'failed' WHERE id = ?");
                $updateStmt->execute([$mail['id']]);
            }
        }
    }

    private function sendMail($email, $name) {
        try {
            // Send email using Mailgun API
            $response = $this->mgClient->messages()->send($this->domain, [
                'from'    => 'Excited User <mailgun@sandbox10140c44e47445b89719b7b24b0e78a6.mailgun.org>',
                'to'      => "$name <$email>",
                'subject' => 'Hello',
                'text'    => 'Registration successful'
            ]);

            return true;
        } catch (Exception $e) {
            error_log('Mailgun API Error: ' . $e->getMessage());
            return false;
        }
    }
}
