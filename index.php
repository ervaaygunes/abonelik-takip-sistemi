<?php
require_once 'includes/session.php';
require_once 'config/database.php';

// Kullanıcı giriş yapmışsa dashboard'a yönlendir
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonelik Takip Uygulaması</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="display-4 mb-4">Abonelik Takip Uygulaması</h1>
                <p class="lead mb-4">Dijital servislerinizi tek bir yerden takip edin.</p>
                <div class="d-grid gap-2 d-md-block">
                    <a href="login.php" class="btn btn-primary btn-lg me-md-2">Giriş Yap</a>
                    <a href="register.php" class="btn btn-outline-primary btn-lg">Kayıt Ol</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 