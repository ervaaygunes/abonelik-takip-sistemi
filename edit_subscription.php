<?php
require_once 'includes/session.php';
require_once 'config/database.php';

// Oturum kontrolü
requireLogin();

$errors = [];
$subscription = null;

// ID kontrolü
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

// Aboneliği getir
$stmt = $db->prepare("SELECT * FROM subscriptions WHERE id = ? AND user_id = ?");
$stmt->execute([$_GET['id'], $_SESSION['user_id']]);
$subscription = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$subscription) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_name = trim($_POST['service_name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $renewal_day = intval($_POST['renewal_day'] ?? 0);
    $auto_renew = isset($_POST['auto_renew']) ? 1 : 0;
    $notes = trim($_POST['notes'] ?? '');

    // Validasyon
    if (empty($service_name)) {
        $errors[] = "Servis adı zorunludur.";
    }
    if (empty($category)) {
        $errors[] = "Kategori zorunludur.";
    }
    if ($price <= 0) {
        $errors[] = "Geçerli bir fiyat giriniz.";
    }
    if ($renewal_day < 1 || $renewal_day > 31) {
        $errors[] = "Yenileme günü 1-31 arasında olmalıdır.";
    }

    // Güncelleme işlemi
    if (empty($errors)) {
        $stmt = $db->prepare("
            UPDATE subscriptions 
            SET service_name = ?, category = ?, price = ?, renewal_day = ?, auto_renew = ?, notes = ?
            WHERE id = ? AND user_id = ?
        ");
        
        if ($stmt->execute([$service_name, $category, $price, $renewal_day, $auto_renew, $notes, $_GET['id'], $_SESSION['user_id']])) {
            $_SESSION['success'] = "Abonelik başarıyla güncellendi.";
            header('Location: dashboard.php');
            exit;
        } else {
            $errors[] = "Abonelik güncellenirken bir hata oluştu.";
        }
    }
}

include 'templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Abonelik Düzenle</h2>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Servis Adı</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" value="<?php echo htmlspecialchars($_POST['service_name'] ?? $subscription['service_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Seçiniz</option>
                            <option value="Streaming" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Streaming') ? 'selected' : ''; ?>>Streaming</option>
                            <option value="Müzik" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Müzik') ? 'selected' : ''; ?>>Müzik</option>
                            <option value="Oyun" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Oyun') ? 'selected' : ''; ?>>Oyun</option>
                            <option value="Yazılım" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Yazılım') ? 'selected' : ''; ?>>Yazılım</option>
                            <option value="Hosting" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Hosting') ? 'selected' : ''; ?>>Hosting</option>
                            <option value="Domain" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Domain') ? 'selected' : ''; ?>>Domain</option>
                            <option value="Diğer" <?php echo (($_POST['category'] ?? $subscription['category']) === 'Diğer') ? 'selected' : ''; ?>>Diğer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Aylık Ücret (₺)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($_POST['price'] ?? $subscription['price']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="renewal_day" class="form-label">Yenileme Günü</label>
                        <input type="number" class="form-control" id="renewal_day" name="renewal_day" min="1" max="31" value="<?php echo htmlspecialchars($_POST['renewal_day'] ?? $subscription['renewal_day']); ?>" required>
                        <div class="form-text">Her ayın kaçıncı günü yenileneceğini belirtin (1-31)</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="auto_renew" name="auto_renew" <?php echo (($_POST['auto_renew'] ?? $subscription['auto_renew']) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="auto_renew">Otomatik Yenileme</label>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notlar</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo htmlspecialchars($_POST['notes'] ?? $subscription['notes']); ?></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
                        <a href="dashboard.php" class="btn btn-outline-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?> 