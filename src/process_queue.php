<?php
require __DIR__ . '/../config/db.php';
require 'MailQueue.php';

$mailQueue = new MailQueue($pdo);
$mailQueue->processQueue();
