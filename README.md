# Laravel OrderLab Scheduler with Supervisor

Panduan ini menjelaskan cara menjalankan perintah `php artisan orderlab:run` secara otomatis setiap 10 detik menggunakan **Supervisor**, untuk proses bridging order laboratorium dari sistem eksternal.

---

## 🧱 1. Install Supervisor (Ubuntu/Debian)

```bash
sudo apt install supervisor
```

Cek status Supervisor:

```bash
sudo systemctl status supervisor
```

Pastikan statusnya `active (running)`.

---

## 📁 2. Buat File Konfigurasi Supervisor

Buat file konfigurasi:

```bash
sudo nano /etc/supervisor/conf.d/orderlab.conf
```

Isi dengan konfigurasi berikut:

```ini
[program:orderlab]
command=/bin/bash -c 'while true; do php /var/www/html/api-order-khanza/artisan orderlab:run; sleep 10; done'
directory=/var/www/html/api-order-khanza
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/html/api-order-khanza/storage/logs/orderlab_supervisor.log
```

📌 Keterangan:
- `sleep 10` artinya perintah akan dijalankan setiap **10 detik** (6x per menit).
- Sesuaikan `directory` dan `command` dengan path Laravel kamu.
- Pastikan `user=www-data` sesuai dengan user web server kamu.

---

## 🔁 3. Reload & Jalankan Supervisor

Setelah membuat file konfigurasi, jalankan:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start orderlab
```

Cek status:

```bash
sudo supervisorctl status orderlab
```

Jika benar, statusnya akan terlihat seperti:
```
orderlab   RUNNING   pid 1234, uptime 0:00:10
```

---

## 🪵 4. Cek Log Output Supervisor

Gunakan perintah berikut untuk melihat log output perintah Artisan:

```bash
tail -f /var/www/html/api-order-khanza/storage/logs/orderlab_supervisor.log
```

Log ini mencatat setiap kali perintah `orderlab:run` dijalankan, dan bisa kamu gunakan untuk debugging jika ada error.

---

## 🧼 5. Tips Tambahan

- Pastikan Laravel kamu sudah bisa diakses dan tidak ada error `.env`, permission, atau route.
- Kamu bisa meningkatkan `memory_limit` dan `max_execution_time` di command jika proses berat:

```php
// Di handle() OrderLabCommand.php
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300);
```

---

## ✅ Done

Sekarang sistem kamu akan otomatis menjalankan `php artisan orderlab:run` setiap 10 detik tanpa perlu intervensi manual 🎉
