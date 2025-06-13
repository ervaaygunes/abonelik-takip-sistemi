# Abonelik Takip Uygulaması (Subscription Tracker)

Bu proje, kullanıcıların dijital servisler için yaptıkları abonelikleri takip edebilecekleri, yönetebilecekleri ve organize edebilecekleri bir web uygulamasıdır. Modern web teknolojileri kullanılarak geliştirilmiş, güvenli ve kullanıcı dostu bir arayüze sahiptir.

## 🎯 Temel Özellikler

### 👤 Kullanıcı Yönetimi
- Güvenli kayıt ve giriş sistemi
- Şifre sıfırlama özelliği
- Profil yönetimi
- Oturum güvenliği

### 📱 Abonelik Yönetimi
- Yeni abonelik ekleme
- Mevcut abonelikleri listeleme ve filtreleme
- Abonelik bilgilerini düzenleme
- Abonelik silme ve arşivleme
- Yenileme tarihi takibi
- Otomatik yenileme durumu kontrolü

### 🏷️ Kapsamlı Kategori Sistemi
- Streaming Servisleri (Netflix, Disney+, Prime Video, vb.)
- Müzik Platformları (Spotify, Apple Music, YouTube Music, vb.)
- Oyun Abonelikleri (Xbox Game Pass, PlayStation Plus, vb.)
- Yazılım Lisansları (Adobe Creative Cloud, Microsoft 365, vb.)
- Hosting ve Domain Hizmetleri
- Depolama Servisleri (Google Drive, Dropbox, vb.)
- Diğer Dijital Servisler

## 🛠️ Kullanılan Teknolojiler

- **Backend**: PHP 7.4+
- **Veritabanı**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Güvenlik**: PDO, Prepared Statements
- **Responsive Tasarım**: Bootstrap 5
- **Veritabanı Yönetimi**: phpMyAdmin

## 📋 Sistem Gereksinimleri

- PHP 7.4 veya üzeri
- MySQL/MariaDB 5.7+
- Web sunucusu (Apache/Nginx)
- mod_rewrite etkin Apache sunucusu
- PHP PDO eklentisi
- GD kütüphanesi (resim işleme için)

## 🔧 Kurulum Adımları

1. XAMPP'ı bilgisayarınıza kurun
2. MySQL ve Apache servislerini başlatın
3. phpMyAdmin üzerinden veritabanını oluşturun
4. Projeyi XAMPP'ın htdocs klasörüne kopyalayın
5. `config/database.php` dosyasından veritabanı bağlantı ayarlarını yapın
6. Tarayıcınızdan `http://localhost/PHP_MySQL_Projesi` adresine gidin

## 📸 Uygulama Görselleri

### Giriş Ekranı
![Giriş Yap](screenshots/girisyap.png)
*Kullanıcı giriş ekranı - Güvenli ve kullanıcı dostu arayüz*

### Kayıt Ekranı
![Kayıt Ol](screenshots/kayitol.png)
*Yeni kullanıcı kayıt formu - Detaylı bilgi girişi ve doğrulama*

### Abonelik Oluşturma
![Abonelik Oluştur](screenshots/abonelikolustur.png)
*Yeni abonelik ekleme formu - Kapsamlı kategori ve detay seçenekleri*

### Abonelik Takip
![Abonelik Takip](screenshots/aboneliktakip.png)
*Abonelik listeleme ve yönetim ekranı - Filtreleme ve arama özellikleri*

## 🔐 Güvenlik Özellikleri

- PDO prepared statements ile SQL injection koruması
- XSS (Cross-Site Scripting) koruması
- CSRF (Cross-Site Request Forgery) koruması
- Güvenli şifre hashleme (password_hash)
- Input validasyonu ve sanitizasyonu
- Güvenli oturum yönetimi
- SSL/TLS desteği

## 📊 Veritabanı Yapısı

### Users Tablosu
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Subscriptions Tablosu
```sql
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    price DECIMAL(8,2),
    renewal_day INT,
    auto_renew BOOLEAN DEFAULT 1,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 🐛 Hata Ayıklama ve Loglama

- Detaylı hata mesajları
- Hata log dosyaları
- Kullanıcı aktivite logları
- Veritabanı işlem logları
- Geliştirici modu

## 📝 Kod Standartları

- PSR-4 autoloading standardı
- PSR-12 kodlama standardı
- Temiz kod prensipleri
- Kapsamlı dokümantasyon
- Yorum satırları ve açıklamalar

## 🤝 Katkıda Bulunma

1. Bu depoyu fork edin
2. Yeni bir branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Değişikliklerinizi commit edin (`git commit -m 'feat: Add amazing feature'`)
4. Branch'inizi push edin (`git push origin feature/amazing-feature`)
5. Pull Request oluşturun

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için `LICENSE` dosyasına bakın.

## 👥 İletişim

Proje Sahibi - [@github_username](https://github.com/github_username)

Proje Linki: [https://github.com/github_username/repo_name](https://github.com/github_username/repo_name)

## Kurulum

1. Projeyi web sunucunuza yükleyin
2. `config/database.php` dosyasındaki veritabanı bağlantı bilgilerinin doğru olduğundan emin olun
3. Veritabanı bağlantısı için `localhost` kullanılmalıdır

## Önemli Notlar

- Veritabanı bağlantısı için host adresi olarak `localhost` kullanılmalıdır
- Hata ayıklama modu aktif durumdadır
- PDO kullanılarak güvenli veritabanı bağlantısı sağlanmıştır

## Hata Ayıklama

Eğer veritabanı bağlantı hatası alırsanız:
1. Veritabanı sunucusunun çalıştığından emin olun
2. Bağlantı bilgilerinin doğru olduğunu kontrol edin
3. Host adresinin `localhost` olduğundan emin olun

## Güvenlik

- Veritabanı şifreleri ve hassas bilgiler güvenli bir şekilde saklanmalıdır
- PDO prepared statements kullanılarak SQL injection saldırılarına karşı koruma sağlanmıştır

## 🎯 Özellikler

- 👤 Kullanıcı Yönetimi
  - Kayıt olma
  - Giriş yapma
  - Oturum kapatma

- 📱 Abonelik Yönetimi
  - Yeni abonelik ekleme
  - Mevcut abonelikleri listeleme
  - Abonelik bilgilerini düzenleme
  - Abonelik silme

- 🏷️ Abonelik Kategorileri
  - Streaming (Netflix, Disney+, vb.)
  - Müzik (Spotify, Apple Music, vb.)
  - Oyun (Xbox Game Pass, PlayStation Plus, vb.)
  - Yazılım (Adobe Creative Cloud, Microsoft 365, vb.)
  - Hosting
  - Domain
  - Video
  - Film
  - Depolama
  - Diğer

- 💰 Abonelik Detayları
  - Aylık/yıllık ücret
  - Yenileme günü
  - Otomatik yenileme durumu
  - Notlar

## 📋 Kurulum

1. XAMPP'ı bilgisayarınıza kurun
2. MySQL ve Apache servislerini başlatın
3. phpMyAdmin üzerinden `subscription_tracker` adında yeni bir veritabanı oluşturun
4. Projeyi XAMPP'ın htdocs klasörüne kopyalayın
5. Tarayıcınızdan `http://localhost/PHP_MySQL_Projesi` adresine gidin

## 🔧 Veritabanı Yapısı

### Users Tablosu
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Subscriptions Tablosu
```sql
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    price DECIMAL(8,2),
    renewal_day INT,
    auto_renew BOOLEAN DEFAULT 1,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 📸 Ekran Görüntüleri

![Giriş Yap](screenshots/girisyap.png)
![Kayıt Ol](screenshots/kayitol.png)
![Abonelik Oluştur](screenshots/abonelikolustur.png)
![Abonelik Takip](screenshots/aboneliktakip.png)

## 🎥 Demo Video

[Demo video bağlantısı buraya eklenecek]

## 👨‍💻 Geliştirici

