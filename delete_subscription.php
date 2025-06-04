<?php
require_once 'includes/session.php';
require_once 'config/database.php';

// Oturum kontrolü
requireLogin();

// ID kontrolü
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

// Aboneliği sil
$stmt = $db->prepare("DELETE FROM subscriptions WHERE id = ? AND user_id = ?");
if ($stmt->execute([$_GET['id'], $_SESSION['user_id']])) {
    $_SESSION['success'] = "Abonelik başarıyla silindi.";
} else {
    $_SESSION['error'] = "Abonelik silinirken bir hata oluştu.";
}

header('Location: dashboard.php');
exit; 