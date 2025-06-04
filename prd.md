Product Requirements Document (PRD)
🎯 Proje Adı: Abonelik Takip Uygulaması (Subscription Tracker)
👤 Geliştirici: [Senin adın]
🔧 Teknolojiler:
	•	PHP (yalın, framework kullanılmayacak)
	•	MySQL (veritabanı)
	•	HTML, CSS (Bootstrap veya benzeri kütüphane)
	•	İsteğe bağlı JavaScript

1. 🎯 Projenin Amacı
Kullanıcıların dijital servisler (Netflix, Spotify, Hosting, Domain vb.) için yaptıkları abonelikleri kaydedebileceği, takip edebileceği, düzenleyebileceği ve silebileceği bir web uygulaması geliştirmek.

2. 👤 Kullanıcı İşlevleri
✅ Kullanıcı Kaydı
	•	Ad, e-posta ve şifre girerek kayıt olur.
	•	Şifre password_hash() kullanılarak veritabanına güvenli şekilde kaydedilir.
🔐 Oturum Açma/Kapama
	•	password_verify() ile şifre doğrulama yapılır.
	•	$_SESSION kullanılarak oturum yönetimi sağlanır.
	•	Oturumu kapatma işlemi için session_destroy() kullanılır.

3. 📦 Uygulama Özellikleri (CRUD)
➕ Abonelik Ekle (Create)
	•	Abonelik adı (ör: Netflix, Spotify)
	•	Abonelik türü (streaming, domain, yazılım vb.)
	•	Aylık/yıllık ücret
	•	Yenileme günü
	•	Otomatik yenileniyor mu? (evet/hayır)
	•	Not (isteğe bağlı)
📋 Abonelik Listeleme (Read)
	•	Kullanıcının sadece kendi eklediği abonelikler listelenir.
	•	Filtreleme: abonelik türü / otomatik yenileme / ücret aralığı
	•	Listeleme Bootstrap kart veya tablo olarak gösterilir.
✏️ Abonelik Güncelleme (Update)
	•	Kullanıcı eklediği aboneliği güncelleyebilir.
❌ Abonelik Silme (Delete)
	•	Kullanıcı kendi abonelik verisini silebilir.
	•	Silmeden önce JavaScript ile onay alınabilir.

4. 💾 Veritabanı Tasarımı (MySQL)
sql
KopyalaDüzenle
-- users tablosu
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- subscriptions tablosu
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_name VARCHAR(100) NOT NULL,
    category VARCHAR(50), -- örn: Streaming, Domain, Yazılım
    price DECIMAL(8,2),
    renewal_day INT, -- örn: her ayın 15’i
    auto_renew BOOLEAN DEFAULT 1,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

5. 🎨 Arayüz Gereksinimleri
	•	Bootstrap veya benzeri bir hazır CSS kütüphanesi kullanılmalı.
	•	Tüm formlar, butonlar, liste öğeleri stilize edilmelidir (ham HTML görünüm yasak).
	•	Responsive (mobil/tablet uyumlu) tasarıma dikkat edilmelidir.

6. ⚙️ Teknik Gereksinimler (Zorunlu Kurallar)
Kural
Açıklama
🔐 Şifre
password_hash() kullanılmalı
👥 Oturum
$_SESSION ile kontrol edilmeli
❌ Hazır PHP kütüphane
Kullanılmamalı
🧠 AI.md dosyası
ChatGPT gibi araçlardan alınan yardımlar markdown olarak eklenmeli
🚫 .htaccess
KULLANILMAMALI
🧠 Readme.md
Açıklama, ekran görüntüleri ve 1-3 dakikalık video bağlantısı içermeli
☁️ Hosting
Uygulama öğrenciye özel sunucuda canlı çalışmalı
🔐 Gizli bilgiler
GitHub’a yüklemeden önce temizlenmeli (ör: şifre, db ayarı)


7. ✅ Puanlama Kriterlerini Karşılama
Özellik
Var mı?
Kullanıcı Kaydı
✅
Oturum Açma/Kapama
✅
Bilgi Girişi (Abonelik Ekleme)
✅
Listeleme
✅
Güncelleme
✅
Silme
✅
CSS Kütüphanesi Kullanımı
✅
Github Readme.md
✅
Ekran Görüntüsü + Video
✅
Canlıda Sorunsuz Çalışma
✅


🛠 Geliştirme Tavsiyeleri
	•	Form inputlarını valide et (boş bırakılmamalı)
	•	Fiyatlar için step="0.01" kullan
	•	Dashboard'da aylık toplam harcama gösterebilirsin (bonus!)
	•	Kullanıcıya “kaç gün kaldı” gösterimi eklemek iyi olabilir
