<?php
require_once 'includes/session.php';
require_once 'config/database.php';

// Oturum kontrolü
requireLogin();

// Kullanıcının aboneliklerini getir
$stmt = $db->prepare("
    SELECT * FROM subscriptions 
    WHERE user_id = ? 
    ORDER BY renewal_day ASC
");
$stmt->execute([$_SESSION['user_id']]);
$subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Aylık toplam harcama
$stmt = $db->prepare("
    SELECT SUM(price) as total 
    FROM subscriptions 
    WHERE user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

include 'templates/header.php';
?>

<div class="row mb-4">
    <div class="col-md-6">
        <h2>Aboneliklerim</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="add_subscription.php" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Yeni Abonelik Ekle
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Aylık Toplam</h5>
                <h3 class="card-text"><?php echo number_format($total, 2); ?> ₺</h3>
            </div>
        </div>
    </div>
</div>

<?php if (empty($subscriptions)): ?>
    <div class="alert alert-info">
        Henüz hiç aboneliğiniz bulunmuyor. Yeni bir abonelik eklemek için "Yeni Abonelik Ekle" butonuna tıklayın.
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($subscriptions as $subscription): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($subscription['service_name']); ?></h5>
                        <p class="card-text">
                            <strong>Kategori:</strong> <?php echo htmlspecialchars($subscription['category']); ?><br>
                            <strong>Fiyat:</strong> <?php echo number_format($subscription['price'], 2); ?> ₺<br>
                            <strong>Yenileme Günü:</strong> <?php echo $subscription['renewal_day']; ?><br>
                            <strong>Otomatik Yenileme:</strong> <?php echo $subscription['auto_renew'] ? 'Evet' : 'Hayır'; ?>
                        </p>
                        <?php if ($subscription['notes']): ?>
                            <p class="card-text">
                                <small class="text-muted"><?php echo htmlspecialchars($subscription['notes']); ?></small>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100">
                            <a href="edit_subscription.php?id=<?php echo $subscription['id']; ?>" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i> Düzenle
                            </a>
                            <a href="delete_subscription.php?id=<?php echo $subscription['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Bu aboneliği silmek istediğinizden emin misiniz?')">
                                <i class="bi bi-trash"></i> Sil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'templates/footer.php'; ?> 